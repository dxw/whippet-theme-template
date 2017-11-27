<?php

return \Symfony\CS\Config\Config::create()
->level(\Symfony\CS\FixerInterface::PSR2_LEVEL)
->finder(
    \Symfony\CS\Finder\DefaultFinder::create()
    ->exclude('vendor')
    ->exclude('assets')
    ->exclude('static')
    ->exclude('templates')
    ->exclude('node_modules')
    ->in(__DIR__)
);
