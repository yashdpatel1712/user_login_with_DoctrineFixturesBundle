<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
            $user = new User();
            $user->setUsername('user@gmail.com');
            $user->setEmail('user@gmail.com');
            $password = $this->passwordHasher->hashPassword($user, 'user@1234');
            $user->setPassword($password);
            $manager->persist($user);

        $manager->flush();
    }
}