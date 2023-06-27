<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Psr\Container\ContainerInterface;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;

class EntrypointLookupFactory
{
    private const ENTRYPOINT_JSON = 'entrypoints.json';

    public function __invoke(ContainerInterface $container): EntrypointLookup
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
