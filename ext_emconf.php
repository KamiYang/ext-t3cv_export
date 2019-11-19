<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3 CONF VARS Export',
    'description' => 'Extbase console command to dump and export TYPO3 CONF VARS',
    'category' => 'misc',
    'state' => 'alpha',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Jan Stockfisch',
    'author_email' => 'github@jan-stockfisch.de',
    'author_company' => '',
    'version' => '0.1',
    'constraints' => [
        'depends' => [
            'php' => '7.0.0-7.99.99',
            'typo3' => '8.7.0-9.5.99',
            'extbase' => '8.7.0-9.5.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
