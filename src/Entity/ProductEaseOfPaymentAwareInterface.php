<?php

namespace Dotit\SyliusEaseOfPaymentPlugin\Entity;

interface ProductEaseOfPaymentAwareInterface
{
    public function getProductEaseOfPayment(): ?ProductEaseOfPaymentInterface;
    public function setProductEaseOfPayment(?ProductEaseOfPaymentInterface $productEaseOfPayment): void;
}
