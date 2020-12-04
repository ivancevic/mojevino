<?php namespace App\Controller;

use App\Entity\Vina;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;	


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MojeVinoController extends Controller {
	/**
	* @Route("/", name="vina_list")
	*/
	public function index() {
		$vina = $this->getDoctrine()->getRepository(Vina::class)->findAll();		
		
		return $this->render('mojevino/index.html.twig', array('vina' => $vina));	
	}



	/**
	 * @Route("/vino/new", name="new_vino")
	 * Method({"GET", "POST"})
	 */
	public function new(Request $request) {
		$vina = new Vina();

		$form = $this->createFormBuilder($vina)->add('name', TextType::class, array('attr' => array('class' => 'form-control')))
											   ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control')))
											   ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-success mt-3')))
											   ->getForm();
		
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$vino = $form->getData();

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($vino);
			$entityManager->flush();

			return $this->redirectToRoute('vina_list');
		}
		
		return $this->render('mojevino/new.html.twig', array(
			'form' => $form->createView()
		));
	}

	/**
	 * @Route("/vino/edit/{id}", name="edit_vino")
	 * Method({"GET", "POST"})
	 */
	public function edit(Request $request, $id) {
		
		$vina = new Vina();
		$vina = $this->getDoctrine()->getRepository(Vina::class)->find($id);

		$form = $this->createFormBuilder($vina)->add('name', TextType::class, array('attr' => array('class' => 'form-control')))
											   ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control')))
											   ->add('save', SubmitType::class, array('label' => 'Update', 'attr' => array('class' => 'btn btn-success mt-3')))
											   ->getForm();
		
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->flush();

			return $this->redirectToRoute('vina_list');
		}
		
		return $this->render('mojevino/edit.html.twig', array(
			'form' => $form->createView()
		));
	}

	/**
	 * @Route("/vino/delete/{id}")
	 * @Method({"DELETE"})
	 */
	public function delete(Request $request, $id) {
		$vino = $this->getDoctrine()->getRepository(Vina::class)->find($id);

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->remove($vino);
		$entityManager->flush();

		$response = new Response();
		$response->send();
	}
	
	/**
	 * @Route("/vino/{id}", name="vina_show")
	 */
	public function show($id) {
		$vino = $this->getDoctrine()->getRepository(Vina::class)->find($id);

		return $this->render('mojevino/show.html.twig', array('vino' => $vino));
	}
	/**
	 * @Route("/vina/save")
	 */
	 /*
	public function save() {
		$entityManager = $this->getDoctrine()->getManager();
		
		$vina = new Vina();
		$vina->setName('Vranac');
		$vina->setDescription('It is protected as intellectual property and Montenegrin geographical indication of origin since 1977.');
		
		$entityManager->persist($vina);
		$entityManager->flush();
		
		return new Response('Saves new Wine with id of '.$vina->getID());

	} */	
}
