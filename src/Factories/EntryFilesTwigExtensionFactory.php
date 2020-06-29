<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Mehrkanal\EncoreTwigExtension\Extensions\EntryFilesTwigExtension;
use Psr\Container\ContainerInterface;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;

class EntryFilesTwigExtensionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new EntryFilesTwigExtension($container->get(EntrypointLookup::class));
    }
}
