# lesscss package

This is a lesscss package using its php implementation (lessphp by leafo).
More about lesscss: http://lesscss.org/
More about lessphp: http://leafo.net/lessphp

## Installing

Download or clone from Github. Put it on 'less' dir in the packages dir and add to your app/config/config.php.

Package made for Fuel 1.0, but i guess it should work fine with 1.1

## Usage

```php
// will compile app/less/style.less to base_url/assets/css/style.css
Asset::less('style.less');

// same syntax as  Asset::css()
Asset::less(array('style.less', 'file1.less', 'admin/style.less'));
```

## Config and runtime config

Currently there's just the path to source less files to config, just open PKGPATH/less/config/less.php and change it as you wish.

## Updating lessphp

Currently there's just the path to source less files to config, just open PKGPATH/less/config/less.php and change it as you wish.

Have fun!