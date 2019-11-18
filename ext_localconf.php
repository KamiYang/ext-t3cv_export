<?php
defined('TYPO3_MODE') or die();

call_user_func(static function () {
    $isBackendRequest = TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_BE;
    $isCliRequest = TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_CLI;

    if ($isCliRequest || $isBackendRequest) {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = KamiYang\T3cvExport\Command\EnvironmentCommandController::class;
    }
});
