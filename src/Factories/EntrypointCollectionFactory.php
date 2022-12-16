<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Laminas\ServiceManager\ServiceLocatorInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupCollection;

class EntrypointCollectionFactory
{
    public function __invoke(ServiceLocatorInterface $container): EntrypointLookupCollection
    {
        return new EntrypointLookupCollection(
            new ServiceLocator([
                '_default' => fn () => $container->build(EntrypointLookup::class),
            ])
        );
    }
}
