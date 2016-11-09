<?php

declare(strict_types=1);

namespace Tests;

use Nette\Utils\FileSystem;
use PHPUnit_Framework_BaseTestListener;
use PHPUnit_Framework_TestSuite;

final class ClearLogAndCacheTestListener extends PHPUnit_Framework_BaseTestListener
{
    public function endTestSuite(PHPUnit_Framework_TestSuite $testSuite)
    {
        if ($testSuite->getName()) {
            return;
        }

        foreach ($this->getTempAndLogDirectories() as $path => $info) {
            FileSystem::delete($path);
        }
    }

    /**
     * @return string[]
     */
    private function getTempAndLogDirectories(): array
    {
        return [
            __DIR__ . '/cache',
            __DIR__ . '/logs',
        ];
    }
}
