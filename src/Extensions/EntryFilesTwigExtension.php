<?php
/** @noinspection SlowArrayOperationsInLoopInspection */

namespace Mehrkanal\EncoreTwigExtension\Extensions;

use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupInterface;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\TagRenderer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EntryFilesTwigExtension extends AbstractExtension
{
    protected array $defaultAttributes = [];
    /* https://github.com/symfony/recipes/blob/6f4230fd1081f5d5a1e9b5303c3a8d9e2e1b0691/symfony/webpack-encore-bundle/1.9/config/packages/webpack_encore.yaml#L8 */
    protected array $defaultLinkAttributes = ['defer' => true];
    protected array $defaultScriptAttributes = [];
    private array $renderedFiles;

    public function __construct(
        private EntrypointLookup $entryPoints,
        private ?EventDispatcherInterface $eventDispatcher = null
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('encore_entry_js_files', [$this, 'getWebpackJsFiles']),
            new TwigFunction('encore_entry_css_files', [$this, 'getWebpackCssFiles']),
            new TwigFunction('encore_entry_script_tags', [$this, 'renderWebpackScriptTags'], ['is_safe' => ['html']]),
            new TwigFunction('encore_entry_link_tags', [$this, 'renderWebpackLinkTags'], ['is_safe' => ['html']]),
            new TwigFunction('encore_get_css_source', [$this, 'getCssSourceFromEntrypoint'], ['is_safe' => ['html']]),
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


    public function getWebpackJsFiles(string $entryName): array
    {
        return $this->getEntrypointLookup()
            ->getJavaScriptFiles($entryName);
    }

    public function getEntrypointLookup(): EntrypointLookupInterface
    {
        return $this->entryPoints;
    }

    public function getWebpackCssFiles(string $entryName): array
    {
        $entrypoint = $this->getEntrypointLookup();
        $cssFiles = $entrypoint->getCssFiles($entryName);
        $entrypoint->reset();
        return $cssFiles;
    }

    public function renderWebpackScriptTags(
        string $entryName,
        string $packageName = null,
        string $entrypointName = '_default',
        array $attributes = []
    ): string {
        return $this->getTagRenderer()
            ->renderWebpackScriptTags($entryName, $packageName, $entrypointName, $attributes);
    }

    public function renderWebpackLinkTags(
        string $entryName,
        string $packageName = null,
        string $entrypointName = '_default',
        array $attributes = []
    ): string {
        return $this->getTagRenderer()
            ->renderWebpackLinkTags($entryName, $packageName, $entrypointName, $attributes);
    }

    private function getTagRenderer(): TagRenderer
    {
        $packages = new Packages(
            new Package(
                new JsonManifestVersionStrategy(
                    __DIR__ . '/../../../../../public/assets/manifest.json'
                )
            )
        );

        return new TagRenderer(
            $this->entryPoints,
            $packages,
            $this->defaultAttributes,
            $this->defaultScriptAttributes,
            $this->defaultLinkAttributes,
            $this->eventDispatcher
        );
    }
}
