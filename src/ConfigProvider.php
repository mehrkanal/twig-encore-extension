<?php

namespace Mehrkanal\EncoreTwigExtension;

use Mehrkanal\EncoreTwigExtension\Extensions\GetCssSourceTwigExtension;
use Mehrkanal\EncoreTwigExtension\Factories\EntrypointCollectionFactory;
use Mehrkanal\EncoreTwigExtension\Factories\AssetUrlFactory;
use Mehrkanal\EncoreTwigExtension\Factories\EntryFilesTwigExtensionFactory;
use Mehrkanal\EncoreTwigExtension\Factories\EntryPointLookupFactory;
use Mehrkanal\EncoreTwigExtension\Factories\GetCssSourceTwigExtensionFactory;
use Mehrkanal\EncoreTwigExtension\Factories\TagRenderFactory;
use Symfony\Bridge\Twig\Extension\AssetExtension;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension;

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
                EntryFilesTwigExtension::class => EntryFilesTwigExtensionFactory::class,
                AssetExtension::class => AssetUrlFactory::class,
                'webpack_encore.tag_renderer' => TagRenderFactory::class,
                'webpack_encore.entrypoint_lookup_collection' => EntrypointCollectionFactory::class,
            ],
        ];
    }
}
