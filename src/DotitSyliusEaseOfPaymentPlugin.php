<?php

declare(strict_types=1);

namespace Dotit\SyliusEaseOfPaymentPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class DotitSyliusEaseOfPaymentPlugin extends Bundle
{
    use SyliusPluginTrait;
}
