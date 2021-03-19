<?php

namespace App\Controller;
use App\Entity\City;
use App\Repository\CityRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{

    private $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * @Route("/city", name="city")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CityController.php',
        ]);
    }

    /**
     * @Route("/City/new", name="create_city")
     */

    public function createCity(): Response{

        if ($request->getMethod() === 'POST') {
            
            $name = $request->get('name');
            $zipcode = $request->get('zipcode');

            $city = new City();
            $city->setName($name);
            $city->setZipcode($zipcode);

            $this->cityRepository->addCity($city);

            $this->addFlash('success', 'city bien ajouter');
            return $this->redirectToRoute('city_show');

        }else{

            return $this->render('City/addCity.html.twig');
        }  
    }



    /**
     * @Route("/City/delete/{id}", name="delete_city")
     * @Method ({"DELETE"})
     */
   
    public function deleteCity($id){
        $city = $this->getDoctrine()->getRepository(City::class)->find($id);
        $this->cityRepository->deleteCity($city);       
        $this->addFlash('success', 'city bien supprimer');
        return $this->redirectToRoute('city_show');
    }





}
