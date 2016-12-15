<?php



namespace Ridoux\AdminBundle\Controller;

use Ridoux\AdminBundle\Entity\Structure;
use Ridoux\AdminBundle\Form\StructureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdminController extends Controller

{

    public function indexAction()

    {
		$content = $this->get('templating')->render('RidouxAdminBundle:Admin:index.html.twig', array('nom'=> 'Hamashi'));
        return new Response($content);

    }
	
	
    public function produitAction($id)

    {
		$structure = $this->getDoctrine()
		->getManager()
		->getRepository('RidouxAdminBundle:Structure')
		->find($id)
		;
		
		if($structure != NULL)
		{
			$content = $this->get('templating')->render('RidouxAdminBundle:Admin:produit.html.twig', array('structure'=> $structure));
			return new Response($content);
		}

		return $this->redirectToRoute('ridoux_admin_404');
    }
	/**

	* @Security("has_role('ROLE_USER')")

	**/
	public function ajouterAction(Request $request)
	{
		$structure = new Structure();
		$form   = $this->get('form.factory')->create(StructureType::class, $structure);


		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($structure);
			$em->flush();
			return $this->redirectToRoute('ridoux_admin_produit', array('id' => $structure->getId()));

		}


		return $this->render('RidouxAdminBundle:Admin:formulaire.html.twig', array('form' => $form->createView(), ));
	}
	
	
	
	/**

	* @Security("has_role('ROLE_USER')")

	**/
	public function supprimerAction(Request $request, $id)
	{
		$em = $this->getDoctrine()->getManager();
		$structure = $em
		->getRepository('RidouxAdminBundle:Structure')
		->find($id)
		;
		if($structure!=NULL)
		{	
			$em->remove($structure);
			$em->flush();
		
			return $this->redirectToRoute('ridoux_admin_home');
		}
		else
		{
			return $this->redirectToRoute('ridoux_admin_404');
		}
	}
	
	/**
	* @Security("has_role('ROLE_USER')")
	**/
	public function modifierAction(Request $request, $id)
	{
		$structure = $this->getDoctrine()
		->getManager()
		->getRepository('RidouxAdminBundle:Structure')
		->find($id)
		;
		
		if($structure != NULL)
		{
			$form   = $this->get('form.factory')->create(StructureType::class, $structure);


			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
			{
				$em = $this->getDoctrine()->getManager();
				$em->persist($structure);
				$em->flush();
				return $this->redirectToRoute('ridoux_admin_produit', array('id' => $structure->getId()));
			}
			
			return $this->render('RidouxAdminBundle:Admin:formulaire.html.twig', array('form' => $form->createView(), ));
		}
		else
			return $this->redirectToRoute('ridoux_admin_404');
	}
	
	public function listeAction($type)
	{
		$repository = $this	
		->getDoctrine()
		->getManager()
		->getRepository('RidouxAdminBundle:Structure');

		$liststructure = $repository->findBy(
			array('type' => $type),
			null,
			null,
			0
		);
		if($liststructure != NULL)
			return $this->render('RidouxAdminBundle:Admin:liste.html.twig', array('type'=> $type, 'liststructure' => $liststructure));
		else
			return $this->redirectToRoute('ridoux_admin_404');
 
	}
	
	public function promotionAction()
	{
		$repository = $this	
		->getDoctrine()
		->getManager()
		->getRepository('RidouxAdminBundle:Structure');

		$liststructure = $repository->findAll();
		
		if($liststructure != NULL)
			return $this->render('RidouxAdminBundle:Admin:promo.html.twig', array('liststructure' => $liststructure));
		else
			return $this->redirectToRoute('ridoux_admin_404');
		
	}
}