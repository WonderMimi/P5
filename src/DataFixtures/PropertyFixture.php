<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture implements FixtureGroupInterface
{
	/**
	 * @param \Doctrine\Persistence\ObjectManager $manager
	 */
	public function load(ObjectManager $manager)
    {
    	$faker = Factory::create('fr_FR');  //Faker is a PHP library that generates fake data
        for ($i = 0; $i < 100; $i++)
		{
			$property = new Property();
			$property->setTitle($faker->words(3,true))
				->setDescription($faker->sentences(3, true))
				->setSurface($faker->numberBetween(20,400))
				->setRooms($faker->numberBetween(2,10))
				->setFloor($faker->numberBetween(0, 15))
				->setBedrooms($faker->numberBetween(1,9))
				->setPrice($faker->numberBetween(90000,1000000))
				->setHeat($faker->numberBetween(0,count(property::HEAT) - 1))
				->setCity($faker->city)
				->setAddress($faker->address)
				->setPostalCode($faker->postcode)
				->setSold(false);
			$manager->persist($property);
		}
         $manager->flush();
    }

	public static function getGroups(): array
	{
		return ['group1'];
	}
}
