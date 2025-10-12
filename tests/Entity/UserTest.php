<?php
// filepath: tests/Entity/UserTest.php
namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserSetUsername(): void
    {
        $user = new User();
        $user->setUsername('testuser');
        $this->assertEquals('testuser', $user->getUsername());
    }
    
    public function testUserGetUserIdentifier(): void
    {
        $user = new User();
        $user->setUsername('admin');
        $this->assertEquals('admin', $user->getUserIdentifier());
    }
    
    public function testUserHasRoleUser(): void
    {
        $user = new User();
        $roles = $user->getRoles();
        $this->assertContains('ROLE_USER', $roles);
    }
    
    public function testUserSetPassword(): void
    {
        $user = new User();
        $user->setPassword('hashed123');
        $this->assertEquals('hashed123', $user->getPassword());
    }
}