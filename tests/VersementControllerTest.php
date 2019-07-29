<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VersementControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/versement');
  
        $rep=$client->getResponse();
        $this->assertSame(401,$client->getResponse()->getStatusCode());
      // $this->assertJsonStringEqualsJsonString($jsonstring,$rep->getContent());
      
    }
}
