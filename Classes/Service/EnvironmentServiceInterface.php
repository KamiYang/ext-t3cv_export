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

interface EnvironmentServiceInterface
{
    public function getTypo3ConfVars(array $whitelist, bool $removeDefaultValues = false): array;
}
