# whippet-theme-template

A base theme suitable for basing new themes upon.

Not desigened for use a parent theme.

## Health warning

This theme is not finished yet. We'd love it if you want to have a play and give us your thoughts - and pull requests gratefully received. But probably best to tread carefully.

## Testing

PHP tests (part of `.travis.yml`):

    vendor/bin/phpunit

JavaScript does not have tests yet.

## Linting

PHP linting (part of `.travis.yml`):

    composer global require fabpot/php-cs-fixer
    php-cs-fixer

JS linting (not part of `.travis.yml`, but part of `grunt watch`):

    grunt standard

## Building

Composer dependencies are compiled into `vendor.phar` which should then be checked into git. This is run automatically when running `composer install` or `composer update`.

CSS/JS assets are compiled into `build/` (`.map` files are gitignored). This can be run once via `grunt`, or assets can be built when files are modified by running `grunt watch`. Must run `npm install` before running `grunt`.

## Code layout

- `app/`
    - `di.php`
        - Loads everything in `app/`. (Loads composer dependencies, sets up autoloading)
    - `Registrar.php`
        - Where dependency injection and registration happens
    - `Lib/`
        - TODO
    - `Posts/`
        - TODO
    - `Theme/`
        - TODO
- `assets/`
    - `img/`
        - Place for raw images (they get minified by grunt and put in `build/img/`)
    - `js/`
        - `main.js`
            - TODO
        - `plugins/`
            - TODO
    - `scss/`
        - `main.scss`
            - TODO
        - `common/`
            - TODO
        - `templates/`
            - TODO
- `build/`
    - TODO
- `lib/`
    - TODO
- `templates/`
    - `functions.php`
        - TODO
    - `layouts`
        - TODO
    - `partials`
        - TODO
    - `style.css`
        - TODO
- `tests/`
    - TODO

TODO:

```
├── vendor
├── composer.json
├── composer.lock
├── bower.json
├── Gruntfile.js
├── LICENSE.txt
├── package.json
├── phpunit.xml
├── README.md
└── vendor.phar
```
