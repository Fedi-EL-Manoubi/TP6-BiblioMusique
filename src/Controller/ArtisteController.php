<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Repository\ArtisteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtisteController extends AbstractController
{
    /**
     * @Route("/artistes", name="artistes", methods={"GET"})
     */
    public function listeArtistes(ArtisteRepository $repo)
    {
        $artistes=$repo->listeArtistesComplete();
        return $this->render('artiste/listeArtistes.html.twig', [
            'lesArtistes' => $artistes
        ]);
    }

        /**
     * @Route("/artiste/{id}", name="ficheArtiste", methods={"GET"})
     */
    public function ficheArtiste(artiste $artiste)
    {
        return $this->render('artiste/ficheArtiste.html.twig', [
            'leArtiste' => $artiste
        ]);
    }
}
