<?php

namespace Dotit\SyliusEaseOfPaymentPlugin\Service;

use Dotit\SyliusEaseOfPaymentPlugin\Entity\ProductEaseOfPayment;
use Dotit\SyliusEaseOfPaymentPlugin\Repository\ModalityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dotit\SyliusEaseOfPaymentPlugin\Repository\ProductEaseOfPaymentRepository;
use Sylius\Component\Core\Model\ProductInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

 class EaseOfPaymentService
 {
     private $modalityRepository;

     public function __construct(
         ModalityRepository $modalityRepository
     ) {
         $this->modalityRepository = $modalityRepository;
     }

     public function getEaseOfPaymentForProduct(int $productPrice): ProductEaseOfPayment
     {
         $productEaseOfPayment= new ProductEaseOfPayment();
         $modalities = $this->modalityRepository->findAll();
         $price=$productPrice/100;
         $productEaseOfPayment->setHaveProductEaseOfPaymentModalities(false);
         $easeOfPaymentModalities=[];
         foreach ($modalities as $modality) {
             $nbOfMonths=$modality->getNbOfMonths();
             $interestRate=$modality->getInterestRate();
             $minPrice=$modality->getMinPrice();
             $maxPrice=$modality->getMaxPrice();
             $allTaxons=$modality->getAllTaxons();
             //$taxons=$modality->getTaxons();
             //$excludedProducts=$modality->getExcludedProducts();
             if($allTaxons){
                 if($price>$minPrice && $price<$maxPrice){
                     $productEaseOfPayment->setHaveProductEaseOfPaymentModalities(true);
                     $modalitltyPrice=($price*$interestRate)/$nbOfMonths;
                     $easeOfPaymentModalities[$nbOfMonths]= (int)$modalitltyPrice;
                 }
             }
         }
         $productEaseOfPayment->setEaseOfPaymentModalities($easeOfPaymentModalities);
         return $productEaseOfPayment;
     }

 }
