<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupCollection;

class EntrypointLookupCollectionFactory
{
    public function __invoke(ContainerInterface $container): EntrypointLookupCollection
    {
        $entrypoint = $container->get(EntrypointLookup::class);

        $container = new Container();
        $container->set('_default', $entrypoint);

        return new EntrypointLookupCollection($container);
    }
}
