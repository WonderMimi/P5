<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{
	/**
	 * @var \App\Repository\PropertyRepository
	 */
	private $propertyRepository;

	public function __construct(PropertyRepository $propertyRepository)
	{
		$this->propertyRepository = $propertyRepository;

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
	 * @param \App\Entity\Property $property
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(Property $property): Response
	{
		return $this->render('admin/property/edit.html.twig', [
			'property' => $property
		]);
	}




}