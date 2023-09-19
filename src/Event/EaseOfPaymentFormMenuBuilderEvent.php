<?php

declare(strict_types=1);

namespace Dotit\SyliusEaseOfPaymentPlugin\Event;

use Dotit\SyliusEaseOfPaymentPlugin\Entity\ModalityInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

class EaseOfPaymentFormMenuBuilderEvent extends MenuBuilderEvent
{
    public function __construct(
        FactoryInterface $factory,
        ItemInterface $menu,
        private ModalityInterface $modality
    ) {
        parent::__construct($factory, $menu);
    }

    public function getNewsletter(): ModalityInterface
    {
        return $this->modality;
    }
}
