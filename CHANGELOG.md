## 4.0.0

- Update webpack-encore-bundle to ver 2.0
- Set minimal PHP Version to 8.1
- Update Build dependencies

## 3.0.2

- Use `$container->get('config')['debug']` to throw error if asset is missing.

## 3.0.1

- Fix second call of ->render() ignores encore_entry_css_files

## 3.0.0

- Use absolute Path in `['twig']['asset_url']`, not relative to `$_SERVER['request_url']`

## 2.2.0

- Show path in config not as `/../../../../manifest.json` - use realpath

## 2.1.0

- Use JsonManifestVersioning strategy

## 2.0.2

- Use more native Symfony code

## 1.0.2

- Update to php8.0

## 0.2.2

- Bugfix: encore_get_css_source could not be called twice

## 0.2.1

- Auto choose asset folder

## 0.2.0

- add function encore_get_css_source

## 0.1.1

- Fixed Typo
- Added Twig Extension Config as one step

## 0.1.0

- Initizal Release
- Create Mezzio Compatible Twig Extension for Webpack Encore
