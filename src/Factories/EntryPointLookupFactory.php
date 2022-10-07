<?php

namespace Mehrkanal\EncoreTwigExtension\Factories;

use Psr\Container\ContainerInterface;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupInterface;

class EntryPointLookupFactory
{
    public function __invoke(ContainerInterface $container): EntrypointLookupInterface
    {
        $config = $container->get('config');

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= $config['twig']['assets_url'] ?? '';
        if (! $this->endsWith($path, '/')) {
            $path .= '/';
        }
        $path .= 'entrypoints.json';

        return new EntrypointLookup($path);
    }

    private function endsWith(string $haystack, string $needle): bool
    {
        $length = strlen($needle);
        if ($length === 0) {
            return true;
        }

        return substr($haystack, -$length) === $needle;
    }
}
