<?php
declare(strict_types = 1);

namespace KamiYang\T3cvExport\Service;

use TYPO3\CMS\Core\Configuration\ConfigurationManager;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

class EnvironmentService implements EnvironmentServiceInterface
{
    protected static $whitelist = [
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

    public function getTypo3ConfVars(bool $removeDefaultValues = false): array
    {
        $this->getConfVarsByWhitelist();

        if ($removeDefaultValues) {
            $this->removeDefaultValues();
        }

        return $this->confVars;
    }

    protected function getConfVarsByWhitelist()
    {
        $confVars = $GLOBALS['TYPO3_CONF_VARS'];
        $confVars = ArrayUtility::flatten($confVars);

        foreach ($confVars as $path => $_) {
            foreach (static::$whitelist as $whitelistedPath) {
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
