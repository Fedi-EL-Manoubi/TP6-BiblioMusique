<?php

namespace App\Controller;

use App\Entity\Label;
use App\Repository\LabelRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LabelController extends AbstractController
{
   /**
     * @Route("/labels", name="labels", methods={"GET"})
     */
    public function listeLabels(LabelRepository $repo)
    {
        $labels=$repo->findAll();
        return $this->render('label/listeLabel.html.twig', [
            'lesLabels' => $labels
        ]);
    }

        /**
     * @Route("/label/{id}", name="ficheLabel", methods={"GET"})
     */
    public function fichelabel(Label $label)
    {
        return $this->render('label/ficheLabel.html.twig', [
            'leLabel' => $label
        ]);
    }
}