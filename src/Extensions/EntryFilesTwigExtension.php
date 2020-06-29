<?php

namespace Mehrkanal\EncoreTwigExtension\Extensions;


use Symfony\Contracts\Service\ResetInterface;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\IntegrityDataProviderInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EntryFilesTwigExtension extends AbstractExtension implements ResetInterface
{
    private $renderedFiles = [];

    /** @var EntrypointLookup */
    private $entryPoints;

    /**
     * ReplacerTwigExtension constructor.
     * @param EntrypointLookup $entryPoints
     */
    public function __construct(EntrypointLookup $entryPoints)
    {
        $this->entryPoints = $entryPoints;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('encore_entry_js_files', [$this, 'getWebpackJsFiles']),
            new TwigFunction('encore_entry_css_files', [$this, 'getWebpackCssFiles']),
            new TwigFunction('encore_entry_script_tags', [$this, 'renderWebpackScriptTags'], ['is_safe' => ['html']]),
            new TwigFunction('encore_entry_link_tags', [$this, 'renderWebpackLinkTags'], ['is_safe' => ['html']]),
        ];
    }

    public function getWebpackJsFiles(string $entryName): array
    {
        return $this->getEntrypointLookup()
            ->getJavaScriptFiles($entryName);
    }

    public function getWebpackCssFiles(string $entryName): array
    {
        return $this->getEntrypointLookup()
            ->getCssFiles($entryName);
    }

    public function renderWebpackScriptTags(string $entryName): string
    {
        $scriptTags = [];
        $entryPointLookup = $this->getEntrypointLookup();
        $integrityHashes = ($entryPointLookup instanceof IntegrityDataProviderInterface)
            ? $entryPointLookup->getIntegrityData()
            : [];

        foreach ($entryPointLookup->getJavaScriptFiles($entryName) as $filename) {
            $attributes = [];
            $attributes['src'] = $this->getAssetPath($filename);

            if (isset($integrityHashes[$filename])) {
                $attributes['integrity'] = $integrityHashes[$filename];
            }

            $scriptTags[] = sprintf(
                '<script %s></script>',
                $this->convertArrayToAttributes($attributes)
            );

            $this->renderedFiles['scripts'][] = $attributes['src'];
        }

        return implode('', $scriptTags);
    }

    public function renderWebpackLinkTags(string $entryName): string
    {
        $scriptTags = [];
        $entryPointLookup = $this->getEntrypointLookup();
        $integrityHashes = ($entryPointLookup instanceof IntegrityDataProviderInterface)
            ? $entryPointLookup->getIntegrityData()
            : [];

        foreach ($entryPointLookup->getCssFiles($entryName) as $filename) {
            $attributes = [];
            $attributes['rel'] = 'stylesheet';
            $attributes['href'] = $this->getAssetPath($filename);

            if (isset($integrityHashes[$filename])) {
                $attributes['integrity'] = $integrityHashes[$filename];
            }

            $scriptTags[] = sprintf(
                '<link %s>',
                $this->convertArrayToAttributes($attributes)
            );

            $this->renderedFiles['styles'][] = $attributes['href'];
        }

        return implode('', $scriptTags);
    }

    public function getEntrypointLookup()
    {
        return $this->entryPoints;
    }

    public function reset()
    {
        $this->renderedFiles = [
            'scripts' => [],
            'styles' => [],
        ];
    }

    private function getAssetPath(string $assetPath): string
    {
        return $assetPath;
    }

    private function convertArrayToAttributes(array $attributesMap): string
    {
        return implode(' ', array_map(
            function ($key, $value) {
                return sprintf('%s="%s"', $key, htmlentities($value));
            },
            array_keys($attributesMap),
            $attributesMap
        ));
    }
}

