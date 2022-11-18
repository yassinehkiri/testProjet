<?php

namespace App\Controller;

use App\Entity\Emp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DeptRepository;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EmpType;
use Symfony\Component\Mime\Message;

class EmpController extends AbstractController
{
    /**
     * @Route("/emp", name="app_emp")
     */
    public function index(): Response
    {
        return $this->render('emp/index.html.twig', [
            'controller_name' => 'EmpController',
        ]);
    }

    
    /**
     * @Route("/afficheP", name="afficheP")
     */
    public function afficheP(): Response
    {

        //rÃ©cupÃ©rer le repository pour utiliser la fonction findAll
        $r = $this->getDoctrine()->getRepository(Emp::class);
        //faire appel Ã  la fonction findAll()
        $produits = $r->findAll();
        
        //ou $r=$this->getDoctrine()->getRepository(Classroom::class)->findAll();
        return $this->render('emp/afficheP.html.twig', [
            'p' => $produits,
        ]);
    }

    /**
     * @Route("/suppP/{empno}", name="suppP")
     */
    public function supp($empno): Response

    {
        //récupérer le classroom à supprimer
        $produits = $this->getDoctrine()->getRepository(Emp::class)->find($empno);
        //on passe à la suppression
        $em = $this->getDoctrine()->getManager();
        $em->remove($produits);
        $em->flush();

        return $this->redirectToRoute('afficheP');
    }

      /**
     * @Route("/ajoutP", name="ajoutP")
     */
    public function ajoutP(Request $request): Response
    {
        //crÃ©ation du formulaire

        $c= new Emp();
        $form = $this->createForm(EmpType::class, $c);
        //rÃ©cupÃ©rer les donnÃ©es saisies depuis la requete http
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
            $this->addFlash('success', 'Employer a été ajoter');

            

            return $this->redirectToRoute('afficheP');
            
        }


             return $this->render('emp/ajoutP.html.twig', [
            'f' => $form->createView(),
        ]);

    }


    /**
     * @Route("/modifP/{empno}", name="modifP")
     */
    public function modifP(Request $request,$empno): Response
    {
        //rÃ©cupÃ©rer le classroom Ã  modifier
        $produit=$this->getDoctrine()->getRepository(Emp::class)->find($empno);
        //crÃ©ation du formulaire rempli
        $form=$this->createForm(EmpType::class,$produit);
        //rÃ©cupÃ©rer les donnÃ©es saisies depuis la requete http
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute('afficheP');
        }

        return $this->render('emp/ajoutP.html.twig', [
            'f' => $form->createView(),
        ]);
    }


    /**
     * @Route("/affichePb", name="affichePb")
     */
    public function afficheproduit(): Response
    {
        //rÃ©cupÃ©rer le repository pour utiliser la fonction findAll
        $r = $this->getDoctrine()->getRepository(Emp::class);
        //faire appel Ã  la fonction findAll()
        $produits= $r->findAll();

        $tables = [];
        foreach($produits as $emp){
            $aux = $emp->getMgr();
            if($aux!= null && !array_key_exists($aux->getempno(), $tables)){
                $tables[$aux->getempno()] = 1;
            }else if($aux != null)
                $tables[$aux->getempno()]++;

            while($aux!= null && $aux->getMgr()!= null){
                $aux = $aux->getMgr(); 
                if(!array_key_exists($aux->getempno(), $tables)){
                    $tables[$aux->getempno()] = 1;
                }else
                    $tables[$aux->getempno()]++;
            }
        }
        
        foreach($produits as $emp){
            if(array_key_exists($emp->getempno(), $tables))
                $emp->nbOcc = $tables[$emp->getempno()];
            else
                $emp->nbOcc = 0 ;
        }
        
        return $this->render('emp/affichePb.html.twig', [
            'p' => $produits,
            'numberRep' => $tables
        ]);
    }

















}
