<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Album;
use App\Entity\Label;
use App\Repository\AlbumRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LabelFixtures extends Fixture
{
    private $albumRepo;
    public function __construct(AlbumRepository $albumRepo){
        $this->albumRepo=$albumRepo;
    }
    
    public function load(ObjectManager $manager): void{
    $faker=Factory::create("fr_FR");

        $label=new Label();
        $label  ->setNom("Warner Music Group")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(5)) . "</p>")
                ->setAnnee(2004)
                ->setType("Majeur")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($label);
                // $manager->flush();
                $this->addReference("label1", $label);

        $label=new Label();
        $label  ->setNom("Universal Music Group")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(5)) . "</p>")
                ->setAnnee(1996)
                ->setType("Majeur")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($label);
                // $manager->flush();
                $this->addReference("label2", $label);

        $label=new Label();
        $label  ->setNom("Polygram Music")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(5)) . "</p>")
                ->setAnnee(1972)
                ->setType("Majeur")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($label);
                // $manager->flush();
                $this->addReference("label3", $label);

        $label=new Label();
        $label  ->setNom("EMI Group")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(5)) . "</p>")
                ->setAnnee(1931)
                ->setType("Majeur")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($label);
                // $manager->flush();
                $this->addReference("label4", $label);

        $label=new Label();
        $label  ->setNom("Alligator")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(5)) . "</p>")
                ->setAnnee(2020)
                ->setType("Indépendant")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($label);
                // $manager->flush();
                $this->addReference("label5", $label);

        $label=new Label();
        $label  ->setNom("Alive Records")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(5)) . "</p>")
                ->setAnnee(2015)
                ->setType("Indépendant")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($label);
                // $manager->flush();
                $this->addReference("label6", $label);

        $label=new Label();
        $label  ->setNom("Alchemy Records")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(5)) . "</p>")
                ->setAnnee(2018)
                ->setType("Indépendant")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($label);
                // $manager->flush();
                $this->addReference("label7", $label);

    $lesAlbums=$this->albumRepo->findAll();
    foreach ($lesAlbums as $album) {
        $album  ->setLabel($this->getReference("label".mt_rand(1,7)));
    }
    $manager->flush();
    }

}
