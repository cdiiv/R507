<?php
// filepath: tests/Controller/MainControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{
    public function testIndexPageWorks(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
    }
    
    public function testIndexHasForm(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertGreaterThan(0, $crawler->filter('form')->count());
    }
    
    public function testConnexionPageWorks(): void
    {
        $client = static::createClient();
        $client->request('GET', '/connexion');
        $this->assertResponseIsSuccessful();
    }
    
    public function testListPageWorks(): void
    {
        $client = static::createClient();
        $client->request('GET', '/liste/1');
        $this->assertResponseIsSuccessful();
    }
    
    public function testListWorksWithAuth(): void
    {
        $client = static::createClient();
        $userRepo = static::getContainer()->get('doctrine')->getRepository(\App\Entity\User::class);
        $user = $userRepo->findOneBy(['username' => 'admin']);
        
        if ($user) {
            $client->loginUser($user);
            $client->request('GET', '/liste/1');
            $this->assertResponseIsSuccessful();
        } else {
            $this->markTestSkipped('Admin user not found');
        }
    }
    
    public function testListHasTable(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/liste/1');
        $this->assertGreaterThan(0, $crawler->filter('table')->count());
    }
    
    public function testListSearchParameter(): void
    {
        $client = static::createClient();
        $client->request('GET', '/liste/1', ['search' => 'test']);
        $this->assertResponseIsSuccessful();
    }
}