<?php

namespace Dotit\SyliusEaseOfPaymentPlugin\Entity;

use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;

interface ModalityInterface extends ResourceInterface
{
    public function getId(): ?int;

    public function getNbOfMonths(): int;

    public function setNbOfMonths(int $nbOfMonths): void;

    public function getInterestRate(): float;

    public function setInterestRate(float $interestRate): void;

    public function getMinPrice(): ?int;

    public function setMinPrice(?int $minPrice): void;

    public function getMaxPrice(): ?int;

    public function setMaxPrice(?int $maxPrice): void;

    public function getAllTaxons(): ?bool;

    public function setAllTaxons(bool $allTaxons): void;

    public function getTaxons(): Collection;

    public function setTaxons(Collection $taxons): void;

    public function getExcludedProducts(): Collection;

    public function setExcludedProducts(Collection $excludedProducts): void;

    public function addTaxon(TaxonInterface $taxon): void;

    public function removeTaxon(TaxonInterface $taxon): void;

    public function addExcludedProduct(ProductInterface $product): void;

    public function removeExcludedProduct(ProductInterface $product): void;
}
