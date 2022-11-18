<?php

namespace App\Controller;

use App\Entity\Dept;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DeptRepository;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DeptType;
use Symfony\Component\Mime\Message;

class DeptController extends AbstractController
{
    /**
     * @Route("/dept", name="app_dept")
     */
    public function index(): Response
    {
        return $this->render('dept/index.html.twig', [
            'controller_name' => 'DeptController',
        ]);
    }

    /**
     * @Route("/afficheC", name="afficheC")
     */
    public function afficheC(): Response
    {
        //rÃ©cupÃ©rer le repository pour utiliser la fonction findAll
        $r=$this->getDoctrine()->getRepository(Dept::class);
        //faire appel Ã  la fonction findAll()
        $categories=$r->findAll();

        //ou $r=$this->getDoctrine()->getRepository(Classroom::class)->findAll();
        return $this->render('dept/afficheC.html.twig', [
            'c' => $categories,
        ]);
    }


    /**
     * @Route("/ajoutC", name="ajoutC")
     */
    public function ajoutC(Request $request): Response
    {
        //crÃ©ation du formulaire

        $c= new Dept();
        $form = $this->createForm(DeptType::class, $c);
        //rÃ©cupÃ©rer les donnÃ©es saisies depuis la requete http
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
            
            

            return $this->redirectToRoute('afficheC');
            
        }


             return $this->render('dept/ajoutC.html.twig', [
            'f' => $form->createView(),
        ]);

    }


    /**
     * @Route("/modifC/{deptno}", name="modifC")
     */
    public function modifP(Request $request,$deptno): Response
    {
        //rÃ©cupÃ©rer le classroom Ã  modifier
        $categorie=$this->getDoctrine()->getRepository(Dept::class)->find($deptno);
        //crÃ©ation du formulaire rempli
        $form=$this->createForm(DeptType::class,$categorie);
        //rÃ©cupÃ©rer les donnÃ©es saisies depuis la requete http
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Ligne de depart a Ã©tÃ© enregistrÃ©e');
            return $this->redirectToRoute('afficheC');
        }

        return $this->render('dept/ajoutC.html.twig', [
            'f' => $form->createView(),
        ]);
    }









     




 /**
     * @Route("/supp/{deptno}", name="suppC")
     */
    public function supp($deptno): Response

    {
        //récupérer le classroom à supprimer
        $categories=$this->getDoctrine()->getRepository(Dept::class)->find($deptno);
        //on passe à la suppression
        $em=$this->getDoctrine()->getManager();
        $em->remove($categories);
        $em->flush();

        return $this->redirectToRoute('afficheC');
    }

}
