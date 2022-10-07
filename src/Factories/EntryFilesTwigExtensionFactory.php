<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Psr\Container\ContainerInterface;
use Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension;

class EntryFilesTwigExtensionFactory
{
    public function __invoke(ContainerInterface $container): EntryFilesTwigExtension
    {
        return new EntryFilesTwigExtension($container);
    }
}
