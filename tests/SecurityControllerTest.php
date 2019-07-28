<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/users');
        $rep=$client->getResponse();
        $this->assertSame(401,$client->getResponse()->getStatusCode());
        //$this->assertJsonStringEqualsJsonString($jsonstring,$rep->getContent());
    }
    // public function testAjoutOk()
    // {
    //     $client = static::createClient();
    //     $crawler = $client->request('POST', '/api/register',[],[],
    //     ['CONTENT_TYPE'=>"application/json"],
    //     '{"username":"test1","plainPassword": "passer","nomComplet": "test"}');
    //     $rep=$client->getResponse();
    //     var_dump($rep);
    //     $this->assertSame(201,$client->getResponse()->getStatusCode());
    // }
}
