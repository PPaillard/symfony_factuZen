<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Invoice;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class InvoiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        // on récupère des clients pour leur relier des factures
        $clients = $manager->getRepository(Client::class)->findAll();

        // on va créer des factures pour des clients aléatoires
        for ($i = 0; $i < 100; $i++) {
            $invoice = new Invoice();
            // on génère une réference unique
            $invoice->setReference('INV-' . $faker->unique()->numberBetween(1000, 9999));
            // On génère une date qui démarre de aujourd'hui (now) - 1 an, jusqu'à maintenant
            $invoice->setIssuedAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween("-1 year", "now")));
            // On prend un élement aléatoire dans la liste dans la liste fournie à faker
            $invoice->setStatus($faker->randomElement(['draft', 'sent', 'paid']));
            // Idem pour le clien
            $invoice->setClient($faker->randomElement($clients));

            $manager->persist($invoice);
        }
        $manager->flush();
    }
}
