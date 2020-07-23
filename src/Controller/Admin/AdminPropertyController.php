<?php

namespace App\Controller\Admin;

use App\Entity\Property;
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
	 * @Route("/admin/{id}", name="admin.property.edit")
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
			return $this->redirectToRoute('admin.property.index');
		}

		return $this->render('admin/property/edit.html.twig', [
			'property' => $property,
			'form' => $form->createView()
		]);
	}




}