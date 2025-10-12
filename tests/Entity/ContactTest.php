<?php

namespace App\Tests\Entity;

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    public function testContactSetFirstName(): void
    {
        $contact = new Contact();
        $contact->setFirstName('Jean');
        $this->assertEquals('Jean', $contact->getFirstName());
    }
    
    public function testContactSetName(): void
    {
        $contact = new Contact();
        $contact->setName('Dupont');
        $this->assertEquals('Dupont', $contact->getName());
    }
    
    public function testContactSetMessage(): void
    {
        $contact = new Contact();
        $contact->setMessage('Test message');
        $this->assertEquals('Test message', $contact->getMessage());
    }
    
    public function testContactStatusDefault(): void
    {
        $contact = new Contact();
        $this->assertEquals('new', $contact->getStatus());
    }
    
    public function testContactSetStatus(): void
    {
        $contact = new Contact();
        $contact->setStatus('treated');
        $this->assertEquals('treated', $contact->getStatus());
    }
}