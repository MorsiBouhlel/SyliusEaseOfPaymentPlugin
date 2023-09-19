<?php
namespace Dotit\SyliusEaseOfPaymentPlugin\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Dotit\SyliusEaseOfPaymentPlugin\Entity\ProductEaseOfPayment;

class ProductEaseOfPaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductEaseOfPayment::class);
    }

    public function deleteAllModalities(): void
    {
        $this->createQueryBuilder('e')
            ->delete()
            ->getQuery()
            ->execute();
    }
}
