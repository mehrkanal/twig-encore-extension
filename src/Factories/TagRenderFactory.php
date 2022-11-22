<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Psr\Container\ContainerInterface;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\TagRenderer;

class TagRenderFactory
{
    protected array $defaultAttributes = [];
    /* https://github.com/symfony/recipes/blob/6f4230fd1081f5d5a1e9b5303c3a8d9e2e1b0691/symfony/webpack-encore-bundle/1.9/config/packages/webpack_encore.yaml#L8 */
    protected array $defaultLinkAttributes = ['defer' => true];
    protected array $defaultScriptAttributes = [];

    public function __invoke(ContainerInterface $container): TagRenderer
    {
        /*
         *    new Package(
                new StaticVersionStrategy(random_int(0,100))
            )
         */
        $packages = new Packages(
            new Package(
                new JsonManifestVersionStrategy(
                    dirname(__DIR__, 5) . '/public/assets/manifest.json'
                )
            )
        );

        return new TagRenderer(
            $container->get(EntrypointLookup::class),
            $packages,
            $this->defaultAttributes,
            $this->defaultScriptAttributes,
            $this->defaultLinkAttributes,
            null
        );
    }
}
