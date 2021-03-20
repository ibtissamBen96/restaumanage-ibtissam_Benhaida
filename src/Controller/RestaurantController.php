<?php

namespace App\Controller;
use App\Entity\Restaurant;
use App\Entity\City;
use App\Repository\RestaurantRepository;
use App\Repository\CityRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{

    private $restaurantRepository;
    private $cityRepository;

    public function __construct(RestaurantRepository $restaurantRepository,
    CityRepository $cityRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * @Route("/Restaurant", name="restaurant")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Restaurant::class);
        $restaurants = $repository->findAll();
        return $this->render('Restaurant/Restaurant.html.twig',['restaurants'=>$restaurants]);
    }



    /**
     * @Route("/Restaurant/new", name="create_restaurant")
     */

    public function createRestaurant(Request $request): Response{


        if ($request->getMethod() === 'POST') {
            
            $restaurant = new Restaurant();

            $name = $request->get('name');
            $description = $request->get('description');
            $city_id = $this->cityRepository->find($request->get('city_id'));

            $restaurant->setName($name);
            $restaurant->setDescription($description);
            $restaurant->setCreatedAt(new \DateTime());
            $restaurant->setCityId($city_id);


            $this->restaurantRepository->addRestaurant($restaurant);

            $this->addFlash('success', 'restaurant bien ajouter');
            return $this->redirectToRoute('restaurant');

        }else{
            $cities = $this->cityRepository->findAll();
            return $this->render('Restaurant/addRestaurant.html.twig',
               ['cities'=>$cities]);
        }  
    }


      /**
     * @Route("/Restaurant/delete/{id}", name="delete_restaurant")
     */
   
    public function deleteRestaurant($id){
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);
        $this->restaurantRepository->deleteRestaurant($restaurant);       
        $this->addFlash('success', 'restaurant bien supprimer');
        return $this->redirectToRoute('restaurant');
    }


    /**
     * @Route("/Restaurant/update/{id}", name="update_restaurant", methods={"GET","POST"})
     */
    public function updateRestaurant(Request $request,$id): Response
    {
        
        if ($request->getMethod() === 'POST')
        {
            // chercher Restaurant
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);

            // modifier Restaurant
            $name = $request->get('name');
            $description = $request->get('description');
            $city_id = $this->cityRepository->find($request->get('city_id'));


            $restaurant->setName($name);
            $restaurant->setDescription($description);
            $restaurant->setCreatedAt(new \DateTime());
            $restaurant->setCityId($city_id);


            $this->restaurantRepository->updateRestaurant();
            
            $this->addFlash('success', 'Restaurant  bien modifier');
            return $this->redirectToRoute('restaurant');

        }else{
            $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);

            $cities = $this->cityRepository->findAll();
            return $this->render('Restaurant/updateRestaurant.html.twig',[
                'cities'=>$cities,
                'restaurant'=>$restaurant,

                ]);
        }
    }

    /**
     * @Route("/Restaurant/show/{id}", name="show_restaurant")
     */
   
    public function showRestaurant($id){
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);
        $city = $this->getDoctrine()->getRepository(City::class)->find($restaurant->getCityId());
        $reviews= $this->restaurantRepository->ListeRestaurantsDetaile($id);
        return $this->render('Restaurant/showRestaurant.html.twig',
        [
            'restaurant'=>$restaurant,
            'city'=>$city,
            'reviews'=>$reviews
            
        ]);
    }


     /**
     * @Route("/Restaurant/AfficherSixD", name="AfficherSixD")
     */
   
    public function AfficherSixD(){

        $restaurantsSixD= $this->restaurantRepository->AfficherSixD();
        return $this->render('Restaurant/Question/AfficherSixD.html.twig',
        ['restaurantsSixD'=>$restaurantsSixD]);
    }

    /**
     * @Route("/Restaurant/AfficherTroisTopM", name="AfficherTroisTopM")
     */
   
    public function AfficherTroisTopM(){
        $restaurantsTroisTopM= $this->restaurantRepository->AfficherTroisTopM();
        return $this->render('Restaurant/Question/AfficherTroisTopM.html.twig',
        ['restaurantsTroisTopM'=>$restaurantsTroisTopM]);
    }

    /**
     * @Route("/Restaurant/ValeurMoyenne", name="ValeurMoyenne")
     */
   
    public function ValeurMoyenne(){
        $restaurants = $this->getDoctrine()->getRepository(Restaurant::class)->findAll();
        return $this->render('Restaurant/Question/AfficherValeurMoyenne.html.twig',
        ['restaurants'=>$restaurants]);
    }


    /**
     * @Route("/Restaurant/classerParVot", name="classerParVot")
     */
   
    public function classerParVot(){
        $restaurants= $this->restaurantRepository->classerParVot();
        return $this->render('Restaurant/Question/classerParVot.html.twig',
        ['restaurants'=>$restaurants]);
    }
     
    



}
