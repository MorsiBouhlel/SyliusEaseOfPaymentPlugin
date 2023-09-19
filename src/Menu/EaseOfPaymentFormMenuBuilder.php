<?php

declare(strict_types=1);

namespace Dotit\SyliusEaseOfPaymentPlugin\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Dotit\SyliusEaseOfPaymentPlugin\Entity\ModalityInterface;
use Dotit\SyliusEaseOfPaymentPlugin\Event\EaseOfPaymentFormMenuBuilderEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class EaseOfPaymentFormMenuBuilder
{
    public function __construct(
        private FactoryInterface $factory,
        private EventDispatcherInterface $eventDispatcher
    ) {
    }

    public function createMenu(array $options = []): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        if (!array_key_exists('EaseOfPayment', $options) || !$options['EaseOfPayment'] instanceof ModalityInterface) {
            return $menu;
        }

        /*$menu
            ->addChild('details')
            ->setAttribute('template', '@DotitSyliusNewsletterPlugin/Admin/Newsletter/Tab/_details.html.twig')
            ->setLabel('sylius.ui.details')
            ->setCurrent(true)
        ;

        $menu
            ->addChild('profile')
            ->setAttribute('template', '@DotitSyliusNewsletterPlugin/Admin/Newsletter/Tab/_profile.html.twig')
            ->setLabel('dotit_sylius_newsletter_plugin.ui.profile')
        ;

        $menu
            ->addChild('media')
            ->setAttribute('template', '@DotitSyliusNewsletterPlugin/Admin/Newsletter/Tab/_media.html.twig')
            ->setLabel('sylius.ui.media')
        ;*/

        $this->eventDispatcher->dispatch(
            new EaseOfPaymentFormMenuBuilderEvent($this->factory, $menu, $options['EaseOfPayment'])
        );

        return $menu;
    }
}
