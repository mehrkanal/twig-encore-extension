<?php

namespace Mehrkanal\EncoreTwigExtension;

use Mehrkanal\EncoreTwigExtension\Extensions\GetCssSourceTwigExtension;
use Mehrkanal\EncoreTwigExtension\Factories\AssetUrlFactory;
use Mehrkanal\EncoreTwigExtension\Factories\EntryFilesTwigExtensionFactory;
use Mehrkanal\EncoreTwigExtension\Factories\EntrypointLookupCollectionFactory;
use Mehrkanal\EncoreTwigExtension\Factories\EntrypointLookupFactory;
use Mehrkanal\EncoreTwigExtension\Factories\GetCssSourceTwigExtensionFactory;
use Mehrkanal\EncoreTwigExtension\Factories\TagRenderFactory;
use Symfony\Bridge\Twig\Extension\AssetExtension;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupCollection;
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
                EntrypointLookupCollection::class => EntrypointLookupCollectionFactory::class,
                EntrypointLookup::class => EntrypointLookupFactory::class,
                GetCssSourceTwigExtension::class => GetCssSourceTwigExtensionFactory::class,
                EntryFilesTwigExtension::class => EntryFilesTwigExtensionFactory::class,
                AssetExtension::class => AssetUrlFactory::class,
                'webpack_encore.tag_renderer' => TagRenderFactory::class,
                'webpack_encore.entrypoint_lookup_collection' => EntrypointLookupCollectionFactory::class,
            ],
        ];
    }
}
