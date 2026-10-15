<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testContactFormDisplay(): void
    {
        $client = static::createClient();
        $client->request('GET', '/contact');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Contact');
    }

    public function testContactFormSubmission(): void
    {
        $client = static::createClient();
        $client->request('GET', '/contact');

        $client->submitForm('Send', [
            'contact[name]' => 'John Doe',
            'contact[email]' => 'john@example.com',
            'contact[message]' => 'Test message'
        ]);

        $this->assertResponseRedirects('/contact/success');
    }
}