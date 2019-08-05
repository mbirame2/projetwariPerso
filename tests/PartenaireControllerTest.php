<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PartenaireControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/partenaire');
  
        $rep=$client->getResponse();
        $this->assertSame(401,$client->getResponse()->getStatusCode());
      // $this->assertJsonStringEqualsJsonString($jsonstring,$rep->getContent());
      
    }

   
}
