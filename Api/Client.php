<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jsiciarek
 * Date: 16.04.13
 * Time: 14:37
 * To change this template use File | Settings | File Templates.
 */

namespace GetResponse\ApiBundle\Api;

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "jsonRPCClient.php";

class Client extends \jsonRPCClient
{

    protected $api = null;
    protected $campaign;
    protected $key;
    protected $contacts_count = 0;

    public function __construct($kernel)
    {
        $this->config = $kernel->getContainer()->getParameter("getresponse.config");
        parent::__construct($this->config["url"]);
        $this->key = $this->config["key"];
        $this->setCampaign($this->config["campaign"]);
        $this->getContactsCount();
    }

    public function addContact($contact)
    {
        $c = array(
            "campaign" => $this->campaign["id"],
            "name"     => $contact["name"],
            "email"    => $contact["email"],
        );

        return $this->add_contact($c);
    }


    public function addContacts($contacts)
    {
        $result = array();

        foreach ($contacts as $contact) {
            $result[] = $this->addContact($contact);
        }

        return $result;
    }

    public function getContacts($page = 1, $page_size = 100)
    {
        $c = array(
            "campaigns"    => array($this->campaign["id"]),
            "segmentation" => array(
                "split" => ceil($this->contacts_count / $page_size),
                "pack"  => $page,
            )
        );

        return $this->get_contacts($c);
    }

    public function getContactsCount()
    {
        $c = array(
            "campaigns" => array($this->campaign["id"]),
        );

        $this->contacts_count = $this->get_contacts_distinct_amount($c);
        return $this->contacts_count;
    }

    public function setCampaign($name)
    {
        $query = array(
            "name" => array("EQUALS" => $name),
        );

        $result = $this->get_campaigns($query);
        $temp = array_values($result);
        $this->campaign = $temp[0];
        $temp = array_keys($result);
        $this->campaign["id"] = $temp[0];
    }

    public function getCampaign()
    {
        return $this->campaign;
    }

    public function __call($method, $params = array())
    {
        array_unshift($params, $this->key);
        return parent::__call($method, $params);
    }
}
