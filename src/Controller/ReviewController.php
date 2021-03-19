<?php

namespace App\Controller;
use App\Entity\Review;
use App\Repository\ReviewRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }


    /**
     * @Route("/review", name="review")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ReviewController.php',
        ]);
    }


    /**
     * @Route("/review/new", name="create_review")
     */

    public function createReview(): Response{

        if ($request->getMethod() === 'POST') {
            
            $message = $request->get('message');
            $rating = $request->get('rating');
            $created_at = $request->get('created_at');

            $review = new Review();

            $review->setMessage($message);
            $review->setRating($rating);
            $review->setCreated_at($created_at);

            $this->reviewRepository->addReview($review);

            $this->addFlash('success', 'review bien ajouter');
            return $this->redirectToRoute('review_show');

        }else{

            return $this->render('Review/addReview.html.twig');
        }  
    }



    /**
     * @Route("/Review/delete/{id}", name="delete_review")
     * @Method ({"DELETE"})
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

            $review->setMessage($message);
            $review->setRating($rating);
            $review->setCreated_at($created_at);
            
            $this->cityRepository->updateReview();
            $this->addFlash('success', 'review bien ajouter');
            return $this->redirectToRoute('review_show');

        }else{
            return $this->render('Review/updateReview.html.twig');
        }
    }

    
}
