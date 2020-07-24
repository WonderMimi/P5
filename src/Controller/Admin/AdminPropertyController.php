<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{
	/**
	 * @var \App\Repository\PropertyRepository
	 */
	private $propertyRepository;
	/**
	 * @var \Doctrine\Common\Persistence\ObjectManager
	 */
	private $em;

	/**
	 * AdminPropertyController constructor.
	 * @param \App\Repository\PropertyRepository   $propertyRepository
	 * @param \Doctrine\ORM\EntityManagerInterface $em
	 */
	public function __construct(PropertyRepository $propertyRepository, EntityManagerInterface $em)
	{
		$this->propertyRepository = $propertyRepository;

		$this->em = $em;
	}

	/**
	 * @Route("/admin", name="admin.property.index")
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function index(): Response
	{
		$properties = $this->propertyRepository->findAll();
		return $this->render('admin/property/index.html.twig', [
			'properties' => $properties
		]);
	}

	/**
	 * @Route("/admin/property/create", name="admin.property.new")
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function new(Request $request)
	{
		$property = new Property();
		$form = $this->createForm(PropertyType::class, $property);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
			$this->em->persist($property);
			$this->em->flush();
			$this->addFlash('success', 'Votre bien a été créé avec succès.');
			return $this->redirectToRoute('admin.property.index');
		}

		return $this->render('admin/property/new.html.twig', [
			'property'=> $property,
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
	 * @param \App\Entity\Property                      $property
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(Property $property, Request $request): Response
	{
		$form = $this->createForm('App\Form\PropertyType', $property);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
			$this->em->flush();
			$this->addFlash('success', 'Votre bien a été modifié avec succès.');
			return $this->redirectToRoute('admin.property.index');
		}

		return $this->render('admin/property/edit.html.twig', [
			'property' => $property,
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
	 * @param \App\Entity\Property                      $property
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
//	methods='DELETE' is defined in an hidden input form field on the twig template
	public function delete(Property $property, Request $request)
	{
		if($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token')))
		{
			$this->em->remove($property);
			$this->em->flush();
			$this->addFlash('success', 'Votre bien a été supprimé avec succès.');
		}

		return $this->redirectToRoute('admin.property.index');
	}


}