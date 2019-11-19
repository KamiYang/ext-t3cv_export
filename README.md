# TYPO3 CONF VARS Exporter

## Exporter

This extension adds a cli command that can be used to export certain TYPO3_CONF_VARS into a dot env (`.env`) file that 
lies outside of the web root. 

## Installation
### Composer (recommended)
Using composer is an easy way to get the extension. Simply run `composer req kamiyang/ext-t3cv_exporter`. 
You might want to use the `:dev-master` version for now as there is no 1.0 release yet.

After installing the extension, you need to enable it to use it in your TYPO3 environment.

## Usage
Currently there are two tasks:

| command | description |
| --- | --- |
| t3cv_export:environment:dump | Prints $GLOBALS[TYPO3_CONF_VARS] that will be exported |
| t3cv_export:environment:export | Export $GLOBALS[TYPO3_CONF_VARS] to .env file |

![Usage demonstration inside a terminal] [usage]

[usage]: Documentation/Images/Usage.png
