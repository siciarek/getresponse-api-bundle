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

        $output = prin_r(array(
            "campaign" => $api->getCampaign(),
            "contacts" => $api->getContacts($page, $page_size),
        ), true);


        return array(
            "campaign" => $output,
        );
    }
}
