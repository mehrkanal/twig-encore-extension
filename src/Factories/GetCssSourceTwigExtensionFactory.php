<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Mehrkanal\EncoreTwigExtension\Extensions\GetCssSourceTwigExtension;
use Psr\Container\ContainerInterface;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;

class GetCssSourceTwigExtensionFactory
{
    public function __invoke(ContainerInterface $container): GetCssSourceTwigExtension
    {
        return new GetCssSourceTwigExtension(
            $container->get(EntrypointLookup::class)
        );
    }
}
