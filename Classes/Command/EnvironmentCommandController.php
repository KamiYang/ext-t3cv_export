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
     * Prints $GLOBALS[TYPO3_CONF_VARS] that will be exported
     *
     * Acts like a dry-run for the export command. Prints all global variables
     * that will be exported by the export command
     *
     * @cli
     */
    public function dumpCommand()
    {
        $vars = $this->objectManager->get(EnvironmentServiceInterface::class)->getTypo3ConfVars(true);
        $this->outputFormatted(DebuggerUtility::var_dump($vars, 'TYPO3_CONF_VARS', 2, true));
    }

    /**
     * Export $GLOBALS[TYPO3_CONF_VARS] to .env file
     *
     * Exports certain $GLOBALS[TYPO3_CONF_VARS] to a .env file that lies outside of the web root.
     *
     * @cli
     */
    public function exportCommand()
    {
        $typo3ConfVars = $this->objectManager->get(EnvironmentServiceInterface::class)->getTypo3ConfVars(true);
        /** @var DotEnvFileWriterServiceInterface $service */
        $service = $this->objectManager->get(DotEnvFileWriterServiceInterface::class);
        if (!$service->write('./.env', $typo3ConfVars, true)) {
            $this->outputLine('<error>An error occurred! The file could not be written.</error>');
        }
    }
}
