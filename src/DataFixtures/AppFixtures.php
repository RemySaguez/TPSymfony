<?php

namespace App\DataFixtures;

use App\Entity\Lieu;
use App\Entity\Evenement;
use App\Entity\Activite;
use App\Entity\Commentaire;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $lieu1 = new Lieu();
        $lieu1->setNom('Salle de conférence');
        $lieu1->setAdresse('123 Rue de la Conférence');
        $manager->persist($lieu1);

        $lieu2 = new Lieu();
        $lieu2->setNom('Théâtre municipal');
        $lieu2->setAdresse('456 Avenue du Théâtre');
        $manager->persist($lieu2);

        $manager->flush();


        $evenement1 = new Evenement();
        $evenement1->setNom('Conférence sur Symfony');
        $evenement1->setDateDebut(new \DateTime('2023-10-01 09:00:00'));
        $evenement1->setDateFin(new \DateTime('2023-10-01 17:00:00'));
        $evenement1->setLieu($lieu1);
        $manager->persist($evenement1);

        $evenement2 = new Evenement();
        $evenement2->setNom('Pièce de théâtre');
        $evenement2->setDateDebut(new \DateTime('2023-10-02 19:00:00'));
        $evenement2->setDateFin(new \DateTime('2023-10-02 21:00:00'));
        $evenement2->setLieu($lieu2);
        $manager->persist($evenement2);

        $manager->flush();


        $activite1 = new Activite();
        $activite1->setNom('Introduction à Symfony');
        $activite1->setDescription('Présentation des bases de Symfony');
        $activite1->setEvenement($evenement1);
        $manager->persist($activite1);

        $activite2 = new Activite();
        $activite2->setNom('Atelier pratique');
        $activite2->setDescription('Atelier pratique sur la création de formulaires');
        $activite2->setEvenement($evenement1);
        $manager->persist($activite2);

        $activite3 = new Activite();
        $activite3->setNom('Répétition générale');
        $activite3->setDescription('Répétition générale de la pièce de théâtre');
        $activite3->setEvenement($evenement2);
        $manager->persist($activite3);

        $manager->flush();


        $commentaire1 = new Commentaire();
        $commentaire1->setContenu('Super conférence !');
        $commentaire1->setDate(new \DateTime('2023-10-01 17:30:00'));
        $commentaire1->setEvenement($evenement1);
        $manager->persist($commentaire1);

        $commentaire2 = new Commentaire();
        $commentaire2->setContenu('La pièce était magnifique !');
        $commentaire2->setDate(new \DateTime('2023-10-02 21:30:00'));
        $commentaire2->setEvenement($evenement2);
        $manager->persist($commentaire2);

        $manager->flush();

        $user = new User();
        $user->setName('John');
        $user->setSurname('Doe');
        $user->setEmail('user@example.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
        $manager->persist($user);

        $admin = new User();
        $admin->setName('Jane');
        $admin->setSurname('Doe');
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'password'));
        $manager->persist($admin);

        $banned = new User();
        $banned->setName('Jim');
        $banned->setSurname('Beam');
        $banned->setEmail('banned@example.com');
        $banned->setRoles(['ROLE_BANNED']);
        $banned->setPassword($this->passwordHasher->hashPassword($banned, 'password'));
        $manager->persist($banned);

        $manager->flush();
    }
}