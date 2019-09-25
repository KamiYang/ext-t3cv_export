<?php
declare(strict_types = 1);

namespace KamiYang\T3cvExport\Service;

interface EnvironmentServiceInterface
{
    public function getTypo3ConfVars(bool $removeDefaultValues = false): array;
}
