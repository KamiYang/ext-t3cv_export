<?php
declare(strict_types = 1);

namespace KamiYang\T3cvExport\Command;

use KamiYang\T3cvExport\Service\DotEnvFileWriterServiceInterface;
use KamiYang\T3cvExport\Service\EnvironmentServiceInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class EnvironmentCommandController extends CommandController
{
    /**
     * @cli
     */
    public function dumpTypo3ConfVarsCommand()
    {
        /** @var EnvironmentServiceInterface $service */
        $service = $this->objectManager->get(EnvironmentServiceInterface::class);
        $vars = $service->getTypo3ConfVars(true);
        $this->outputFormatted(DebuggerUtility::var_dump($vars, 'TYPO3_CONF_VARS', 2, true));
    }

    /**
     * @cli
     */
    public function exportToDotEnvCommand()
    {
        $typo3ConfVars = $this->objectManager->get(EnvironmentServiceInterface::class)->getTypo3ConfVars(true);
        /** @var DotEnvFileWriterServiceInterface $service */
        $service = $this->objectManager->get(DotEnvFileWriterServiceInterface::class);
        if (!$service->write('./.env', $typo3ConfVars, true)) {
            $this->outputLine('<error>An error occurred! The file could not be written.</error>');
        }
    }
}
