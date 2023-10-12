<?php

namespace App\DataFixtures;

use fr;
use Faker\Factory;
use App\Entity\Label;
use App\Entity\Album;
use App\Entity\Style;
use App\Entity\Artiste;
use App\Entity\Morceau;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create("fr_FR");

       $lesStyles=$this->chargeFichier("style.csv");
       foreach ($lesStyles as $key => $value) {
        $style =new Style();
        $style    ->setId(intval($value[0]))
                    ->setNom($value[1])
                    ->setCouleur($faker->safeColorName());
      $manager->persist($style); 
    $this->addReference("style".$style->getId(),$style);
}

       $lesArtistes=$this->chargeFichier("artiste.csv");
$genres=["men","women"];
        foreach ($lesArtistes as $key => $value) {
                $artiste=new Artiste();
                $artiste    ->setId(intval($value[0]))
                            ->setNom($value[1])
                            ->setDescription("<p>". join("</p><p>",$faker->paragraphs(5)) ."</p>")
                            ->setSite($faker->url())
                            ->setImage('https://randomuser.me/api/portraits/'.$faker->randomElement($genres)."/".mt_rand(1,99).".jpg")
                            ->setType($value[2]);
              $manager->persist($artiste); 
            $this->addReference("artiste".$artiste->getId(),$artiste);
        }
            $lesAlbums=$this->chargeFichier("album.csv");
            $manager->flush();
            foreach ($lesAlbums as $key => $value) {
                $album=new Album();
                $album  ->setId(intval($value[0]))
                        ->setNom($value[1])
                        ->setDate(intval($value[2]))
                        ->setImage($faker->imageUrl(640,480))
                        ->addStyle($this->getReference("style".$value[3]))
                        ->setArtiste($this->getReference("artiste".$value[4]));

                        $manager->persist($album);
                        $this->addReference("album".$album->getId(), $album);
            }

            $lesMorceaux=$this->chargeFichier("morceau.csv");
            foreach ($lesMorceaux as $key => $value) {
                $morceau=new Morceau();
                $morceau  ->setId(intval($value[0]))
                        ->setTitre($value[2])
                        ->setAlbum($this->getReference("album".$value[1]))
                        ->setPiste(intval($value[4]))
                        ->setDuree(date("i:s",$value[3]));
                        $manager->persist($morceau);
                        $this->addReference("morceau".$morceau->getId(), $morceau);
            }
            $manager->flush();

    }
    public function chargeFichier($fichier){
        $fichierCsv=fopen(__DIR__."/". $fichier , "r");
        
        while (!feof($fichierCsv)) {
            $data[]=fgetcsv($fichierCsv);
        }
        fclose($fichierCsv);
        return $data;
    }
    
}


