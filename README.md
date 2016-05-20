# whippet-theme-template

A template that should have everything you need to start a new theme with.

## Health warning

This theme is not finished yet. We'd love it if you want to have a play and give us your thoughts - and pull requests gratefully received. But probably best to tread carefully.

## iguana

This theme template makes use of [iguana](https://github.com/dxw/iguana) for dependency injection and auto-registration, [iguana-theme](https://github.com/dxw/iguana-theme) for helper functions, and [iguana-extras](https://github.com/dxw/iguana-extras) for other little modules.

## Code layout

PHP for templates lives in `templates/`, everything else lives in `app/` and is tested with [PHPUnit](https://phpunit.de/) tests that live in `tests/`.

The main JavaScript file is `assets/js/main.js`. It is compiled into `build/main.min.js` with [browserify](http://browserify.org/) so `main.js` is typically just a list of `require()`s.

The main SCSS file is `assets/scss/main.scss`. It is compiled into `build/main.min.css` with [SASS](http://sass-lang.com/) so `main.scss` is typically just a list of `@import`s.

Images live in `assets/img/`. They are pre-processed/minified into `build/img/`.

## Commands

Run PHP tests:

    vendor/bin/phpunit

Build JS/CSS:

    grunt

Build JS/CSS upon file modification:

    grunt watch

## Guide

### Adding a new helper function

Create a new file, say `app/Foobar.php`:

```
<?php

class Foobar
{
    public function __construct(\Dxw\Iguana\Theme\Helpers $helpers)
    {
        $helpers->registerFunction('foobar', [$this, 'foobar']);
    }

    public function foobar()
    {
        // ...
    }
}
```

And instead of adding a `require` to `functions.php`, add a line like this to `app/di.php`:

```
$registrar->addInstance(\Namespace\MyTheme\Foobar::class, new \Namespace\MyTheme\Foobar(
    $registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class)
));
```

And instead of using `foobar()` in your template code, use `h()->foobar()`.

### Registering post types, actions, ACF fields, etc.

Create a new file, say `app/RegisterStuff.php`:

```
<?php

class RegisterStuff implements \Dxw\Iguana\Registerable
{
    public function register()
    {
        register_post_type('stuff', [
            // ...
        ]);
    }
}
```
