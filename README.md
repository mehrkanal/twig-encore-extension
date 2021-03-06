# Twig and Webpack Encore Extension for Laminas

To use with `twig/twig` and `symfony/webpack-encore-bundle`

Created for: `Laminas/Mezzio` Applications without native Symfony Kernel.  
**Warning:** If Symfony is available, just use the bundle as is.

## How to use:

1. Configure Encore
    * `setOutputPath` should be in the public folder
        * i.e. `.setOutputPath('public/assets')`
    * `setPublicPath` should be in the folder where the assets are in
        * i.e. `setPublicPath('/assets')`
1. Make sure to configure `twig.asset_url` to the public path
    * Best be set to: ``/assets/``
    * If is not configured: The path will be `<DOCUMENT_ROOT>/entrypoints.json`
    * Otherwise, it is `<DOCUMENTROOT><asset_url>entrypoints.json`
        * Note: A Forward Slash is appended after asset_url in case the preceding path does not end on a forward slash
        * i.e. asset_path is `/assets` the url will be `<document_root>/assets/entrypoints.json`
1. Include `Mehrkanal\EncoreTwigExtension\ConfigProvider::class` into your global config
1. Include `Mehrkanal\EncoreTwigExtension\Extensions\EntryFilesTwigExtension:class` to your twig extensions config.

```php
use Mehrkanal\EncoreTwigExtension\Extensions\EntryFilesTwigExtension;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

$loader = new FilesystemLoader('./templates');
$twig = new Environment($loader, [
	'debug' => true
]);

$twig->addExtension(new EntryFilesTwigExtension(new EntrypointLookup('./public/build/entrypoints.json')));
```

## What can I do now?

* Use Encore NodeJS Scripts to automatically generate assets
* Use ``encore_entry_link_tags(<entrypoint>)`` function to get all required stylesheet link tags
* Use ``encore_entry_script_tags(<entrypoint>)`` function to get all required script tags
* Use ``encore_get_css_source('/app/public/', <entrypoint>)`` function to get all CSS

Use in combination with setEntry of Encore Webpack Config.

## Stan

```shell
docker run -it -v $PWD:/app -v composer:/root/.composer -v $SSH_AUTH_SOCK:$SSH_AUTH_SOCK -w /app -e SSH_AUTH_SOCK=$SSH_AUTH_SOCK -e SSH_AGENT_PID=$SSH_AGENT_PID registry.mehrkanal.com/docker/phpx/cli:8.0-build bash

composer up
composer run stan
composer run phpcs-fix
```

## Useful links:

* [Original Code](https://github.com/symfony/webpack-encore-bundle/blob/master/src/Twig/EntryFilesTwigExtension.php)
* https://symfony.com/doc/current/frontend/encore/installation.html
* https://gitlab.mehrkanal.com/mehrkanal/skeleton.git

