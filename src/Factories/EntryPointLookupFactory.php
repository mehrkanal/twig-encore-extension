<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Psr\Container\ContainerInterface;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupInterface;

class EntryPointLookupFactory
{
    private const ENTRYPOINT_JSON = 'entrypoints.json';

    public function __invoke(ContainerInterface $container): EntrypointLookupInterface
    {
        $config = $container->get('config');

        $path = $config['twig']['assets_url'] ?? '';
        if (! $this->endsWithSlash($path)) {
            $path .= DIRECTORY_SEPARATOR;
        }
        $path .= self::ENTRYPOINT_JSON;

        return new EntrypointLookup($path);
    }

    private function endsWithSlash(string $haystack): bool
    {
        return substr($haystack, -1) === DIRECTORY_SEPARATOR;
    }
}
