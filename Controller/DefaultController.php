<?php

namespace GetResponse\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/getresponse", defaults={"page":1, "page_size":100})
     * @Route("/getresponse/{page}", defaults={"page_size":100},  requirements={"page":"^[1-9]\d*$"})
     * @Route("/getresponse/{page}/{page_size}", requirements={"page":"^[1-9]\d*$","page_size":"^[1-9]\d*$"})
     * @Template()
     */
    public function indexAction($page, $page_size)
    {
        $api = $this->container->get("getresponse.api");

        $contacts = array(
            array(
                "name" => "Łukasz Łukojć",
                "email" => "l.lukojc@sescom.pl",
            ),
            array(
                "name" => "Dominik Dziąg",
                "email" => "d.dziag@sescom.pl",
            ),
        );

        $result = $api->getContacts($page, $page_size);

        $output = print_r(array($api->getContactsCount(), count($result), $page, $page_size, $result), true);
//        $output = print_r($api->getCampaign(), true);

        return array(
            "campaign" => $output,
        );
    }
}
