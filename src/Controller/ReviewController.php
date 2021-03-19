<?php

namespace App\Controller;
use App\Entity\Review;
use App\Repository\ReviewRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }


    /**
     * @Route("/Review", name="review")
     */

    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Review::class);
        $reviews = $repository->findAll();
        return $this->render('Review/Review.html.twig',['reviews'=>$reviews]);
    }

   

    /**
     * @Route("/Review/new", name="create_review")
     */

    public function createReview(): Response{

        if ($request->getMethod() === 'POST') {
            
            $message = $request->get('message');
            $rating = $request->get('rating');
            $created_at = $request->get('created_at');
            $restaurant_id = $request->get('restaurant_id');
            $user_id = $request->get('user_id');

            $review = new Review();

            $review->setMessage($message);
            $review->setRating($rating);
            $review->setCreated_at($user_id);
            $review->setRestaurantId($restaurant_id);
            $review->setUserId($user_id);

            $this->reviewRepository->addReview($review);

            $this->addFlash('success', 'review bien ajouter');
            return $this->redirectToRoute('review_show');

        }else{

            return $this->render('Review/addReview.html.twig');
        }  
    }



    /**
     * @Route("/Review/delete/{id}", name="delete_review")
     */
   
    public function deleteReview($id){
        $review = $this->getDoctrine()->getRepository(Review::class)->find($id);
        $this->reviewRepository->deleteReview($review);       
        $this->addFlash('success', 'review bien supprimer');
        return $this->redirectToRoute('review_show');
    }




    /**
     * @Route("/Review/update/{id}", name="update_user", methods={"GET","POST"})
     */
    public function updateReview(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // chercher Review
            $review = $this->getDoctrine()->getRepository(Review::class)->find($id);
            
            // modifier Review
            $message = $request->get('message');
            $rating = $request->get('rating');
            $created_at = $request->get('created_at');
            $restaurant_id = $request->get('restaurant_id');
            $user_id = $request->get('user_id');

            $review->setMessage($message);
            $review->setRating($rating);
            $review->setCreated_at($created_at);
            $review->setRestaurantId($restaurant_id);
            $review->setUserId($user_id);
            
            $this->cityRepository->updateReview();
            $this->addFlash('success', 'review bien ajouter');
            return $this->redirectToRoute('review_show');

        }else{
            return $this->render('Review/updateReview.html.twig');
        }
    }

    /**
     * @Route("/Review/show/{id}", name="show_review")
     */
    public function showReview($id){
        $repository = $this->getDoctrine()->getRepository(Review::class);
        $review = $repository->find($id);
        return $this->render('Review/showReview.html.twig',['review'=>$review]);
    }

    
}
