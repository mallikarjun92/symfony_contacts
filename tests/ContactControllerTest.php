<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Csrf\CsrfToken;


class ContactControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        
        $client->request('GET', '/contacts');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    public function testNew()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact/new');
        
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Create a new contact');
        
        // You can also submit a form here if you want to test form submission.
    }
    
    public function testShow()
    {
        $client = static::createClient();
        $client->request('GET', '/contact/5'); // Replace 1 with a valid contact ID
        
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Contact Details');
    }
    
    public function testEdit()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact/5/edit'); // Replace 1 with a valid contact ID
        
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Edit Contact');
        
        // You can also submit a form here if you want to test form submission.
    }
    
    public function testDelete()
    {
        $client = static::createClient();
        $client->request('POST', '/contact/5/delete', ['_token' => 'your_csrf_token']); // Replace 1 and 'your_csrf_token' accordingly
        
        $this->assertResponseRedirects('/contact/');
    }
}

