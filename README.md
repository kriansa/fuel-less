# lesscss package

This is a simple LESS package using its PHP implementation (lessphp by @leafo).

LESS extends CSS with dynamic behavior such as variables, mixins, operations and functions.

More about lesscss: http://lesscss.org/

More about lessphp: http://leafo.net/lessphp

## Installing

Download or clone from Github. Put it on 'packages/less' dir in and add to your app/config/config.php.

	git clone --recursive git@github.com:kriansa/fuel-less.git

Works with Fuel 1.0 and 1.1

## Usage

```php
// will compile app/less/style.less to base_url/assets/css/style.css
Asset::less('style.less');

// same syntax as  Asset::css()
Asset::less(array('style.less', 'file1.less', 'admin/style.less'));
```

## Config

Copy `PKGPATH/less/config/less.php` to your `APP/config/less.php` and change it as you need.

## Updating lessphp

As lessphp is a submodule, update it simply doing

	git pull --recurse-submodules

Have fun!