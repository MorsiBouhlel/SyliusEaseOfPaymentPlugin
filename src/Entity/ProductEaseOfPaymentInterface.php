<?php

namespace Dotit\SyliusEaseOfPaymentPlugin\Entity;

use Sylius\Component\Product\Model\ProductInterface;

interface ProductEaseOfPaymentInterface
{
    public function getEaseOfPaymentModalities(): array;

    public function setEaseOfPaymentModalities(array $easeOfPaymentModalities): void;

    public function getProduct(): ProductInterface;

    public function setProduct(ProductInterface $product): void;

    public function isHaveProductEaseOfPaymentModalities(): bool;

    public function setHaveProductEaseOfPaymentModalities(bool $haveProductEaseOfPaymentModalities): void;
}
