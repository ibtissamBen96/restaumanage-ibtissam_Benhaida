<?php

namespace App\Repository;

use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Restaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurant[]    findAll()
 * @method Restaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }

    // /**
    //  * @return Restaurant[] Returns an array of Restaurant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Restaurant
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    //la methode d'ajoute
    public function addRestaurant($restaurant){
        $entityManager = $this->getEntityManager();
        $entityManager->persist($restaurant);
        $entityManager->flush();
    }

    //la methode de supprission
    public function deleteRestaurant($restaurant){
        $entityManager = $this->getEntityManager();
        $entityManager->remove($restaurant);
        $entityManager->flush();
    }

    //la methode de modification
    public function updateRestaurant()
    {
        $entityManager = $this->getEntityManager();
        $entityManager->flush();
    }


    //la methode pour Afficher les 6 derniers restaurants créés
    public function AfficherSixD()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM restaurant ORDER BY create_at DESC LIMIT 0, 6';

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAllAssociative();
         
    }


    //la methode pour Afficher les 3 top meilleurs restaurants
    public function AfficherTroisTopM()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT AVG(review.rating) as moyenne,name,restaurant.create_at ,restaurant.id as restaurantId 
        FROM review INNER JOIN restaurant
        ON review.restaurant_id_id = restaurant.id 
        GROUP BY restaurant_id_id 
        ORDER BY moyenne DESC LIMIT 0, 3';

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAllAssociative();
      
    }




    //la methode pour Lister les restaurants et leurs détails (review, city..)
    public function ListeRestaurantsDetaile($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
        SELECT restaurant.id, restaurant.name,
        restaurant.description,restaurant.create_at,
        review.message,review.rating,review.user_id_id,
        user.username
        FROM review INNER JOIN restaurant 
        ON review.restaurant_id_id = restaurant.id  
        
        INNER JOIN user ON review.user_id_id=user.id
        where restaurant.id=".$id;
        


        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $restaurants = $stmt->fetchAllAssociative();
        return $restaurants ;
    }


}

