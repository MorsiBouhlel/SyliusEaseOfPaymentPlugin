<?php

namespace Dotit\SyliusEaseOfPaymentPlugin\Command;

use Dotit\SyliusEaseOfPaymentPlugin\Entity\ProductEaseOfPayment;
use Dotit\SyliusEaseOfPaymentPlugin\Repository\ModalityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dotit\SyliusEaseOfPaymentPlugin\Repository\ProductEaseOfPaymentRepository;
use Sylius\Component\Core\Model\ProductInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class UpdateProductEaseOfPaymentCommand extends Command
{
    protected static $defaultName = 'dotit:update:product:ease-of-payment';
    private $modalityRepository;
    private $entityManager;
    private $channelRepository;
    private $productEaseOfPaymentRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        ModalityRepository $modalityRepository,
        RepositoryInterface $channelRepository,
        ProductEaseOfPaymentRepository $productEaseOfPaymentRepository,
    ) {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->modalityRepository = $modalityRepository;
        $this->channelRepository = $channelRepository;
        $this->productEaseOfPaymentRepository = $productEaseOfPaymentRepository;
    }

    protected function configure()
    {
        $this
            ->setDescription('Update product ease of payment command')
            ->setHelp('Help for your update product ease of payment command command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $productRepository = $this->entityManager->getRepository(ProductInterface::class);
        $products = $productRepository->findAll();
        $defaultChannel = $this->channelRepository->findOneByCode('Default'/*'FASHION_WEB'*/);
        $modalities = $this->modalityRepository->findAll();
        $this->productEaseOfPaymentRepository->deleteAllModalities();

        foreach ($products as $product) {
            if($product->isEnabled()){
                $firstProductVariant = $product->getVariants()->first();
                if (!$product->hasVariants()) {
                    continue;
                }
                $channelPricing = $firstProductVariant->getChannelPricingForChannel($defaultChannel);
                $price=($channelPricing->getPrice())/100;
                $productEaseOfPayment= new ProductEaseOfPayment($product);
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
                $haveProductEaseOfPaymentModalities=$productEaseOfPayment->isHaveProductEaseOfPaymentModalities();
                if($haveProductEaseOfPaymentModalities){
                    $product->setProductEaseOfPayment($productEaseOfPayment);
                }else{
                    $product->setProductEaseOfPayment(null);
                }
                $this->entityManager->persist($product);
            }
        }
        $this->entityManager->flush();
        $this->entityManager->clear();
        $output->writeln('<info>Update product ease of payment command executed.</info>');

        return Command::SUCCESS;
    }
}
