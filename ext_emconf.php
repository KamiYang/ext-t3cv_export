<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3 CONF VARS Export',
    'description' => 'Contains configuration for CSS content-rendering of the table "tt_content". This is meant as a modern substitute for the classic "content (default)" template which was based more on <font>-tags, while this is pure CSS.',
        'category' => 'misc',
    'state' => 'alpha',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Jan Stockfisch',
    'author_email' => 'github@jan-stockfisch.de',
    'author_company' => '',
    'version' => '0.0.1',
    'constraints' => [
        'depends' => [
            'php' => '7.0.0-7.2.99',
            'typo3' => '8.7.27'
        ],
        'conflicts' => [],
        'suggests' => array(),
    ],
];
