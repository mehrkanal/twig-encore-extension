<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Psr\Container\ContainerInterface;
use Symfony\Bridge\Twig\Extension\AssetExtension;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;
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
                '_default' => function () use ($entrypointLookupCollection) {
                    return $entrypointLookupCollection;
                },
            ])
        );
    }
}
