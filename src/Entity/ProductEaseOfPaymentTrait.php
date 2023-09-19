<?php

declare(strict_types=1);

namespace Dotit\SyliusEaseOfPaymentPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Dotit\SyliusEaseOfPaymentPlugin\Entity\ProductEaseOfPaymentInterface;
trait ProductEaseOfPaymentTrait
{
    /**
     * @var ProductEaseOfPaymentInterface|null
     *
     * @ORM\OneToOne(targetEntity=ProductEaseOfPaymentInterface::class, cascade={"persist"})
     * @ORM\JoinColumn(name="id_ease_of_payment", referencedColumnName="id", onDelete="SET NULL")
     */
    protected ?ProductEaseOfPaymentInterface $productEaseOfPayment = null;

    public function getProductEaseOfPayment(): ?ProductEaseOfPaymentInterface
    {
        return $this->productEaseOfPayment;
    }

    public function setProductEaseOfPayment(?ProductEaseOfPaymentInterface $productEaseOfPayment): void
    {
        $this->productEaseOfPayment = $productEaseOfPayment;
    }
}
