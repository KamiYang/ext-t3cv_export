<?php
declare(strict_types = 1);

namespace KamiYang\T3cvExport\Service;

interface DotEnvFileWriterServiceInterface
{
    /**
     * @param string $path The path of the file
     * @param array $content Key => value list
     *
     * @param bool $overwrite When true will overwrite the file if it already exists. Otherwise will stop on file existence detection.
     *
     * @return bool Will return true, if the process was successful
     */
    public function write(string $path, array $content, bool $overwrite = false): bool;
}
