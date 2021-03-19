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
     * @Route("/City", name="city")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(City::class);
        $cites = $repository->findAll();
        return $this->render('City/City.html.twig',['cites'=>$cites]);
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
            return $this->redirectToRoute('city');

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
        return $this->redirectToRoute('city');
    }


    /**
     * @Route("/City/update/{id}", name="update_city", methods={"GET","POST"})
     */
    public function updateCity(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // chercher city
            $city = $this->getDoctrine()->getRepository(City::class)->find($id);
            
            // modifier city
            $name = $request->get('name');
            $zipcode = $request->get('zipcode');
            
            $city->setName($name);
            $city->setZipcode($zipcode);

            $this->cityRepository->updateCity();
            $this->addFlash('success', 'city bien ajouter');
            return $this->redirectToRoute('city');

        }else{
            return $this->render('City/updateCity.html.twig');
        }
    }



    /**
     * @Route("/City/show/{id}", name="show_city")
     */
   
    public function showCity($id){
        $repository = $this->getDoctrine()->getRepository(City::class);
        $city = $repository->find($id);
        return $this->render('City/showCity.html.twig',['city'=>$city]);
    }




}
