<?php
namespace App\Repository;
use App\Entity\Post;
use App\Entity\PostLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class PostLikeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PostLike::class);
    }

    public function getCountForPost(Post $post)
    {
        return $this->createQueryBuilder('l')
            ->select('COUNT(l) AS likes')
            ->andWhere('l.post = :post')
            ->setParameter('post', $post)
            ->getQuery()
            ->getSingleScalarResult();
    }
}