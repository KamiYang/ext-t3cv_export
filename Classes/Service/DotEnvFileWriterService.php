<?php
declare(strict_types = 1);

namespace KamiYang\T3cvExport\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class DotEnvFileWriterService implements DotEnvFileWriterServiceInterface
{
    /**
     * @param string $path The path of the file
     * @param array $content Key => value list
     *
     * @param bool $overwrite When true will overwrite the file if it already exists. Otherwise will stop on file existence detection.
     *
     * @return bool Will return true, if the process was successful
     */
    public function write(string $path, array $content, bool $overwrite = false): bool
    {
        $absolutePath = GeneralUtility::getFileAbsFileName($path);

        if (!$overwrite && file_exists($path)) {
            throw new \RuntimeException('File already exists', 1569422779);
        }
        $contentString = '';
        foreach ($content as $key => $value) {
            $key = str_replace('.', '__', $key);
            $contentString .= sprintf('%s=%s' . PHP_EOL, $key, $value);
        }

        return GeneralUtility::writeFile($path, $contentString);
    }
}
