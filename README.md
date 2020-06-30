# Twig Encore Extension
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
    * If unconfigured: The path will be `<DOCUMENT_ROOT>/entrypoints.json`
    * Otherwise it is `<DOCUMENTROOT><asset_url>entrypoints.json` 
        * Note: A Forward Slash is appended after asset_url in case the preceding path does not end on a fordward slash
            * i.e. asset_path is `/assets` the url will be `<document_root>/assets/entrypoints.json`
1. Include `Mehrkanal\EncoreTwigExtension\ConfigProvider::class` into your global config
1. Include `Mehrkanal\EncoreTwigExtension\Extensions\EntryFilesTwigExtension:class` to your twig extensions config.

## What can I do now?
* Use Encore NodeJS Scripts to automatically generate assets
* Use ``encore_entry_link_tags(<entrypoint>)`` function to get all required stylesheet link tags
* Use ``encore_entry_scripts_tags(<entrypoint>)`` function to get all required script tags

 Use in combination with setEntry of Encore Webpack Config.
 
 ## Useful links:
 * [Original Code](https://github.com/symfony/webpack-encore-bundle/blob/master/src/Twig/EntryFilesTwigExtension.php) 
 * https://symfony.com/doc/current/frontend/encore/installation.html
 * https://gitlab.mehrkanal.com/mehrkanal/baseapp.git

