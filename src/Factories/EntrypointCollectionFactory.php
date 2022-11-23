<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupCollection;

class EntrypointCollectionFactory
{
    public function __invoke(ContainerInterface $container): EntrypointLookupCollection
    {
        $entrypointLookupCollection = $container->get(EntrypointLookup::class);
        return new EntrypointLookupCollection(
            new ServiceLocator([
                '_default' => fn() => $entrypointLookupCollection,
            ])
        );
    }
}
