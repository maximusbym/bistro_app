<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Controller\DefaultController;
use Symfony\Component\HttpFoundation\Request;

class DefaultControllerTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // Ajax request
        $crawler = $client->request('POST', '/', array(), array(), array(
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
        ));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
