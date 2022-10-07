<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Mehrkanal\EncoreTwigExtension\Extensions\EntryFilesTwigExtension;
use Psr\Container\ContainerInterface;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\TagRenderer;

class EntryFilesTwigExtensionFactory
{
    public function __invoke(ContainerInterface $container): EntryFilesTwigExtension
    {
        return new EntryFilesTwigExtension(
            $container->get(EntrypointLookup::class),
            $container->get(TagRenderer::class)
        );
    }
}
