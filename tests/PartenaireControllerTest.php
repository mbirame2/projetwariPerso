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

    public function testAjoutOk()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/ajout_partenaire',[],[],
        ['CONTENT_TYPE'=>"application/json"],
        '{"id": 1,
            "raisonSocial": "societe civile",
            "ninea": 85458,
            "adresse": "HLM Grd Dakar",
            "numeroCompte": 532154563,
            "solde": 400000,
            "versements": [
                "/api/versements/1",
                "/api/versements/2",
                "/api/versements/3",
                "/api/versements/4",
                "/api/versements/5"
            ]}');
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(401,$client->getResponse()->getStatusCode());
    }

    public function testAjoutKo()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/ajout_partenaire',[],[],
        ['CONTENT_TYPE'=>"application/json"],
        '{"id": 1,
            "raisonSocial": "societe civile",
            "ninea": 85458,
            "adresse": "HLM Grd Dakar",
            "numeroCompte": 532154563,
            "solde": 400000,
            "versements": [
                "/api/versements/1",
                "/api/versements/2",
                "/api/versements/3",
                "/api/versements/4",
                "/api/versements/5"
            ]}');
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(401,$client->getResponse()->getStatusCode());
    }
   
}
