<?php

namespace App\Controller\Admin;

use App\Entity\Artiste;
use App\Form\ArtisteType;
use App\Repository\ArtisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtisteController extends AbstractController
{
 /**
     * @Route("/admin/artistes", name="admin_artistes", methods={"GET"})
     */
    public function listeArtistes(ArtisteRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        $artistes=$paginator->paginate(
            $repo->listeArtistesCompletePaginee(),
            $request->query->getInt('page', 1), /*page number*/
            9/*limit per page*/
        );
        return $this->render('admin/artiste/listeArtistes.html.twig', [
            'lesArtistes' => $artistes
        ]);

    }

     /**
     * @Route("/admin/artiste/ajout", name="admin_artiste_ajout", methods={"GET","POST"})
     */
    public function ajoutArtiste(Request $request, EntityManagerInterface $manager)
    {

            $artiste=new Artiste();
            $form=$this->createForm(ArtisteType::class, $artiste);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $manager->persist($artiste);
                $manager->flush();
                $this->addFlash("success","L'artiste a bien été Ajouté");
                return $this->redirectToRoute('admin_artistes');
            }
            return $this->render('admin/artiste/formAjoutArtiste.html.twig', [
            'formArtiste' => $form->createView()
        ]);

    }
}
