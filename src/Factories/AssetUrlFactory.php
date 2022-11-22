<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Psr\Container\ContainerInterface;
use Symfony\Bridge\Twig\Extension\AssetExtension;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;

class AssetUrlFactory
{
    public function __invoke(ContainerInterface $container): AssetExtension
    {
        return new AssetExtension(
            new Packages(
                new Package(new JsonManifestVersionStrategy(dirname(__DIR__, 5) . '/public/assets/manifest.json'))
            )
        );
    }
}
