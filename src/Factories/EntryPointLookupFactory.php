<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Psr\Container\ContainerInterface;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupInterface;

class EntryPointLookupFactory
{
    private const ENTRYPOINTS_JSON = 'entrypoints.json';
    private const DIRECTORY_SEPERATOR = '/';

    public function __invoke(ContainerInterface $container): EntrypointLookupInterface
    {
        $config = $container->get('config');

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= $config['twig']['assets_url'] ?? '';
        if (!$this->endsWithSlash($path)) {
            $path .= self::DIRECTORY_SEPERATOR;
        }
        $path .= self::ENTRYPOINTS_JSON;

        return new EntrypointLookup($path);
    }

    private function endsWithSlash(string $haystack): bool
    {
        return substr($haystack, -1) === self::DIRECTORY_SEPERATOR;
    }
}
