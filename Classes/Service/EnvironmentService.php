<?php
declare(strict_types = 1);

namespace KamiYang\T3cvExport\Service;

/*
 * This file is part of the TYPO3 CONF VARS Export project.
 *
 * It is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * For the full copyright and license information, please read
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Configuration\ConfigurationManager;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

class EnvironmentService implements EnvironmentServiceInterface
{
    protected static $defaultWhitelist = [
        'BE.lockIP',
        'DB',
        'FE.pageNotFound_handling',
        'FE.pageNotFound_handling_statheader',
        'SYS.curlProxyServer',
        'SYS.doNotCheckReferer',
        'SYS.sitename',
        'SYS.trustedHostsPattern',
    ];

    /**
     * @var array
     */
    protected $defaultConfiguration;

    /**
     * @var array
     */
    protected $confVars = [];

    public function __construct(ConfigurationManager $configurationManager)
    {
        $this->defaultConfiguration = $configurationManager->getDefaultConfiguration();
    }

    public function getTypo3ConfVars(array $whitelist = null, bool $removeDefaultValues = false): array
    {
        $whitelist = $whitelist ?? static::$defaultWhitelist;

        $this->getConfVarsByWhitelist($whitelist);

        if ($removeDefaultValues) {
            $this->removeDefaultValues();
        }

        return $this->confVars;
    }

    protected function getConfVarsByWhitelist(array $whitelist)
    {
        $confVars = ArrayUtility::flatten($GLOBALS['TYPO3_CONF_VARS']);

        foreach ($confVars as $path => $_) {
            foreach ($whitelist as $whitelistedPath) {
                if ($whitelistedPath && StringUtility::beginsWith($path, $whitelistedPath)) {
                    continue 2;
                }
            }
            unset($confVars[$path]);
        }
        ksort($confVars);
        $this->confVars = $confVars;
    }

    protected function removeDefaultValues()
    {
        $defaultConfig = ArrayUtility::flatten($this->defaultConfiguration);

        foreach ($this->confVars as $path => $value) {
            if ($defaultConfig[$path] === $value) {
                unset($this->confVars[$path]);
            }
        }
    }
}
