<?php

namespace Mehrkanal\EncoreTwigExtension;

use Mehrkanal\EncoreTwigExtension\Extensions\GetCssSourceTwigExtension;
use Mehrkanal\EncoreTwigExtension\Factories\GetCssSourceTwigExtensionFactory;
use Mehrkanal\EncoreTwigExtension\Factories\EntryPointLookupFactory;
use Mehrkanal\EncoreTwigExtension\Factories\TagRenderFactory;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\TagRenderer;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories' => [
                EntrypointLookup::class => EntryPointLookupFactory::class,
                GetCssSourceTwigExtension::class => GetCssSourceTwigExtensionFactory::class,
                TagRenderer::class => TagRenderFactory::class,
            ],
            'aliases' => [
                'webpack_encore.tag_renderer' => TagRenderer::class,
//                'webpack_encore.entrypoint_lookup_collection' => ''
            ],
        ];
    }
}
