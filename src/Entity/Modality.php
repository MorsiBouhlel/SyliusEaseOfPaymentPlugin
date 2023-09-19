<?php

declare(strict_types=1);

namespace Dotit\SyliusEaseOfPaymentPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\TaxonInterface;

class Modality implements ModalityInterface
{
    private ?int $id = null;
    private int $nbOfMonths;
    private float $interestRate;
    private ?int $minPrice;
    private ?int $maxPrice;
    private Bool $allTaxons;

    /**
     * @psalm-var Collection<array-key, TaxonInterface>
     */
    private Collection $taxons;

    /**
     * @psalm-var Collection<array-key, ProductInterface>
     */
    private Collection $excludedProducts;

    public function __construct()
    {
        $this->taxons = new ArrayCollection();
        $this->excludedProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNbOfMonths(): int
    {
        return $this->nbOfMonths;
    }

    public function setNbOfMonths(int $nbOfMonths): void
    {
        $this->nbOfMonths = $nbOfMonths;
    }

    public function getInterestRate(): float
    {
        return $this->interestRate;
    }

    public function setInterestRate(float $interestRate): void
    {
        $this->interestRate = $interestRate;
    }

    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    public function setMinPrice(?int $minPrice): void
    {
        $this->minPrice = $minPrice;
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(?int $maxPrice): void
    {
        $this->maxPrice = $maxPrice;
    }

    public function getAllTaxons(): ?bool
    {
        return $this->allTaxons;
    }

    public function setAllTaxons(bool $allTaxons): void
    {
        $this->allTaxons = $allTaxons;
    }

    public function getTaxons(): Collection
    {
        return $this->taxons;
    }

    public function setTaxons(Collection $taxons): void
    {
        $this->taxons = $taxons;
    }

    public function getExcludedProducts(): Collection
    {
        return $this->excludedProducts;
    }

    public function setExcludedProducts(Collection $excludedProducts): void
    {
        $this->excludedProducts = $excludedProducts;
    }

    public function addTaxon(TaxonInterface $taxon): void
    {
        if (!$this->taxons->contains($taxon)) {
            $this->taxons->add($taxon);
        }
    }

    public function removeTaxon(TaxonInterface $taxon): void
    {
        $this->taxons->removeElement($taxon);
    }

    public function addExcludedProduct(ProductInterface $product): void
    {
        if (!$this->excludedProducts->contains($product)) {
            $this->excludedProducts->add($product);
        }
    }

    public function removeExcludedProduct(ProductInterface $product): void
    {
        $this->excludedProducts->removeElement($product);
    }
}
