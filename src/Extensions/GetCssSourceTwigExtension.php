<?php

namespace Mehrkanal\EncoreTwigExtension\Extensions;

use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class GetCssSourceTwigExtension extends AbstractExtension
{
    public function __construct(
        private EntrypointLookup $entryPoints,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('encore_get_css_source', fn (string $entryName): string => $this->getCssSourceFromEntrypoint(
                $entryName
            ), [
                'is_safe' => ['html'],
            ]),
        ];
    }

    public function getCssSourceFromEntrypoint(string $entryName): string
    {
        $content = '';
        foreach ($this->getWebpackCssFiles($entryName) as $cssFile) {
            $content .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . $cssFile);
        }
        return $content;
    }

    public function getWebpackCssFiles(string $entryName): array
    {
        return $this->entryPoints->getCssFiles($entryName);
    }
}
