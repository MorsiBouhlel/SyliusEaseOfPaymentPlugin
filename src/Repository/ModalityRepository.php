<?php
namespace Dotit\SyliusEaseOfPaymentPlugin\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Dotit\SyliusEaseOfPaymentPlugin\Entity\Modality;

class ModalityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modality::class);
    }

    /**
     * @return Modality[]
     */
    public function findAllModalities(): array
    {
        return $this->createQueryBuilder('m')
            ->getQuery()
            ->getResult();
    }
}
