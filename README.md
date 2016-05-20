# whippet-theme-template

A template that should have everything you need to start a new theme with.

## Health warning

This theme is not finished yet. We'd love it if you want to have a play and give us your thoughts - and pull requests gratefully received. But probably best to tread carefully.

## iguana

This theme template makes use of [iguana](https://github.com/dxw/iguana) for dependency injection and auto-registration, [iguana-theme](https://github.com/dxw/iguana-theme) for helper functions, and [iguana-extras](https://github.com/dxw/iguana-extras) for other little modules.

## Code layout

- `app/`
    - All PHP except for templates and tests lives here
- `templates/`
    - The code in here usually lives in the root of a theme (i.e. `style.css`, `functions.php`, etc), but we like to keep that separate
- `tests/`
    - PHP tests
- `assets/`
    - This is where your raw assets live. Post-compilation files live in `build/`
    - `img/`
        - Raw images (they get minified by grunt and put in `build/img/`)
    - `js/`
        - JavaScript
    - `scss/`
        - SCSS
- `build/`
    - Compiled assets
    - This includes `.map` files, but those are `.gitignored`

## Automated bits

### Testing

PHP tests (part of `.travis.yml`):

    vendor/bin/phpunit

JavaScript does not have tests yet.

### Linting

PHP linting (part of `.travis.yml`):

    composer global require fabpot/php-cs-fixer
    php-cs-fixer

JS linting (not part of `.travis.yml`, but part of `grunt watch`):

    grunt standard

### Building

Composer dependencies are compiled into `vendor.phar` which should then be checked into git. This is run automatically when running `composer install` or `composer update`.

CSS/JS assets are compiled into `build/` (`.map` files are gitignored). This can be run once via `grunt`, or assets can be built when files are modified by running `grunt watch`. Must run `npm install` before running `grunt`.

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
