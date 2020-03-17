<?php

$finder = \PhpCsFixer\Finder::create()
->exclude('vendor')
->exclude('assets')
->exclude('static')
->exclude('templates')
->exclude('node_modules')
->in(__DIR__);

return \PhpCsFixer\Config::create()
->setRules([
    '@PSR2' => true,
    'array_syntax' => ['syntax' => 'short'],
])

->setFinder($finder);
