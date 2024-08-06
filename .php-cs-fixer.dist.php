<?php

//
// We follow PSR12 (https://www.php-fig.org/psr/psr-12/) for a better code consistancy & quality.
// We do however, amend some PSR12 rules to our liking (eg: braces on the same line as class definition).
//
// This is the PHP-CS-Fixer (https://github.com/FriendsOfPHP/PHP-CS-Fixer) config file.
//

$finder = PhpCsFixer\Finder::create()
    ->in(['app', 'tests'])
    ->exclude([
        'vendor',
    ]);

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        // PSR 12 Coding standard as the base.
        '@PSR12' => true,

         // Makes sure there's no un-used imports.
        'no_unused_imports' => true,

        // And order them by length
        'ordered_imports' => [
            'imports_order' => ['class', 'function', 'const'],
            'sort_algorithm' => 'length',
        ],

        // Convert double-quotes to single-quotes for simple strings.
        'single_quote' => true,

        // We like braces on the same line as class/method definitions.
        'curly_braces_position' => [
            'functions_opening_brace' => 'same_line',
            'classes_opening_brace' => 'same_line',
        ],
    ])
    ->setIndent('    ') # 4 spaces.
    ->setLineEnding("\n")
    ->setFinder($finder)
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache');
