<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
	/**
	 * @var PropertyRepository
	 */
	private $propertyRepository;

	/**
	 * @var EntityManagerInterface
	 */
	private $em;

	public function __construct(PropertyRepository $propertyRepository, EntityManagerInterface $em)
	{
		$this->propertyRepository = $propertyRepository;
		$this->em = $em;
	}

	/**
	 * @Route("Biens", name="property.index")
	 * @param \Knp\Component\Pager\PaginatorInterface   $paginator
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 * @return Response
	 */
	public function index(PaginatorInterface $paginator, Request $request): Response
	{
		// 1 code used to enter first property in DB
//		$property = new Property();
//		$property->setTitle('Belle maison au calme')
//				->setAddress('16 rue Bastière')
//				->setBedrooms(3)
//				->setCity('Fontanil')
//				->setFloor(2)
//				->setPostalCode('38120')
//				->setRooms(4)
//				->setSurface(130)
//				->setPrice(450000)
//				->setDescription('Maison neuve contemporaine décorée avec goût dans un petit lotissement de 4 maisons. Située proche du coeur du village dans une rue sans issue.')
//				->setHeat(3);
		//The Entity Manager's role is to persist data end send it to the DB
//		$em = $this->getDoctrine()->getManager();
//		$em->persist($property);
//		$em->flush();

		// 2 Get the data back from the DB using the Repository
//		$property = $this->propertyRepository->findNotSold();
//		$this->em->flush();

		$properties = $paginator->paginate(
			$this->propertyRepository->findNotSoldQuery(),
			$request->query->getInt('page', 1),
			9
		);

		//Returns the properties listing page
		return $this->render('property/index.html.twig', [
			'active_menu' => 'properties',
			'properties' => $properties
		]);
	}

	/**
	 * @Route("/Biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function show($slug, $id): Response
	{
		$property = $this->propertyRepository->find($id);

		return $this->render('property/show.html.twig', [
			'property' => $property,
			'active_menu' => 'properties'
		]);

	}
}