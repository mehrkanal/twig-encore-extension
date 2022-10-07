<?php

namespace Mehrkanal\EncoreTwigExtension;

use Mehrkanal\EncoreTwigExtension\Extensions\EntryFilesTwigExtension;
use Mehrkanal\EncoreTwigExtension\Factories\EntryFilesTwigExtensionFactory;
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
                EntryFilesTwigExtension::class => EntryFilesTwigExtensionFactory::class,
                TagRenderer::class => TagRenderFactory::class,
            ],
        ];
    }
}
