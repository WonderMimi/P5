<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
	/**
	 * @Route("/", name="home")
	 * @param \App\Repository\PropertyRepository $propertyRepository
	 * @return Response
	 */
	public function index(PropertyRepository $propertyRepository): Response
	{
		$properties = $propertyRepository->findLatest(); // retrieves 4 latest added properties
		return $this->render('pages/home.html.twig', [
			'properties' => $properties,  // sends an array of properties to the home view
		]);
	}

}