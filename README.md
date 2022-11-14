# Twig and Webpack Encore Extension for Laminas

To use with `twig/twig` and `symfony/webpack-encore-bundle`

Created for: `Laminas/Mezzio` Applications without native Symfony Kernel.  
**Warning:** If Symfony is available, just use the `symfony/webpack-encore-bundle` bundle as is.

## How to use and configure Encore

1. `composer require symfony/webpack-encore-bundle`
2. npm i @symfony/webpack-encore
3. webpack.config.js
   * `setOutputPath()` should be in the public folder
     * i.e. `.setOutputPath('public/assets')`
   * `setPublicPath()` should be in the folder where the assets are in
     * i.e. `setPublicPath('/assets')`
4. Make sure to configure `['twig']['asset_url']` to the public path, for example in your [twig.global.php](twig.global.php.dist)
   * Best be set to: ``/assets/``
   * If is not configured: The path will be `<DOCUMENT_ROOT>/entrypoints.json`
   * Otherwise, it is `<DOCUMENTROOT><asset_url>entrypoints.json`
   * Note: A Forward Slash is appended after asset_url in case the preceding path does not end on a forward slash
     * i.e. asset_path is `/assets` the url will be `<document_root>/assets/entrypoints.json`
5. Include `Mehrkanal\EncoreTwigExtension\ConfigProvider::class` into your global config
6. Include `Mehrkanal\EncoreTwigExtension\Extensions\GetCssSourceTwigExtension:class` to your twig extensions config.
7. Include `Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension:class` to your `['twig']['extensions']` config.

```php
use Mehrkanal\EncoreTwigExtension\Extensions\GetCssSourceTwigExtension;
use Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';
$container = require __DIR__ . '/container.php';

$loader = new FilesystemLoader('./templates');
$twig = new Environment($loader, [
	'debug' => true
]);

$twig->addExtension($container->get(EntryFilesTwigExtension::class));
$twig->addExtension($container->get(GetCssSourceTwigExtension::class));
```

## What can I do now?

* Use Encore NodeJS Scripts to automatically generate assets
* Use ``encore_entry_link_tags(<entrypoint>)`` function in Twig to get all required stylesheet link tags
* Use ``encore_entry_script_tags(<entrypoint>)`` function in Twig to get all required script tags
* Use ``encore_get_css_source(<entrypoint>)`` function in Twig to get all CSS Code from this entrypoint

Use in combination with setEntry of Encore Webpack Config.

## Stan

```shell
docker run -it -v $PWD:/app -v $SSH_AUTH_SOCK:$SSH_AUTH_SOCK -w /app -e SSH_AUTH_SOCK=$SSH_AUTH_SOCK -e SSH_AGENT_PID=$SSH_AGENT_PID registry.mehrkanal.com/docker/phpx/cli:8.0-build bash

composer up
composer run stan
composer run cs
```

## Useful links:

* [Original Code](https://github.com/symfony/webpack-encore-bundle/blob/master/src/Twig/EntryFilesTwigExtension.php)
* https://symfony.com/doc/current/frontend/encore/installation.html
* https://gitlab.mehrkanal.com/mehrkanal/skeleton.git


## Team

[MKLabs](https://confluence.mehrkanal.com/display/MKLAB/)

