<?php

declare(strict_types=1);

namespace Dotit\SyliusEaseOfPaymentPlugin\Menu;

use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        /** @var ItemInterface $item */
        $item = $menu->getChild('configuration');
        if (null == $item) {
            $item = $menu;
        }

        $item->addChild('EaseOfPayment', ['route' => 'dotit_sylius_ease_of_payment_plugin_admin_modality_index'])
            ->setLabel('dotit_sylius_ease_of_payment_plugin.menu.admin.modality')
            ->setLabelAttribute('icon', 'payment')
        ;
    }
}
