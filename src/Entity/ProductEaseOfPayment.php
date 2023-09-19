<?php

declare(strict_types=1);

namespace Dotit\SyliusEaseOfPaymentPlugin\Entity;

use Sylius\Component\Core\Model\ProductInterface;

class ProductEaseOfPayment implements ProductEaseOfPaymentInterface {

    private ?int $id = 1;
    private array $easeOfPaymentModalities;
    private ProductInterface $product;
    private bool $haveProductEaseOfPaymentModalities;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getEaseOfPaymentModalities(): array
    {
        return $this->easeOfPaymentModalities;
    }

    public function setEaseOfPaymentModalities(array $easeOfPaymentModalities): void
    {
        $this->easeOfPaymentModalities = $easeOfPaymentModalities;
    }

    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    public function setProduct(ProductInterface|\Sylius\Component\Product\Model\ProductInterface $product): void
    {
        $this->product = $product;
    }

    public function isHaveProductEaseOfPaymentModalities(): bool
    {
        return $this->haveProductEaseOfPaymentModalities;
    }

    public function setHaveProductEaseOfPaymentModalities(bool $haveProductEaseOfPaymentModalities): void
    {
        $this->haveProductEaseOfPaymentModalities = $haveProductEaseOfPaymentModalities;
    }
}
