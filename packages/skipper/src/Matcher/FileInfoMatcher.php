<?php

declare(strict_types=1);

namespace Symplify\Skipper\Matcher;

use Symplify\Skipper\FileSystem\FnMatchPathNormalizer;
use Symplify\SmartFileSystem\SmartFileInfo;

final class FileInfoMatcher
{
    public function __construct(
        private FnMatchPathNormalizer $fnMatchPathNormalizer
    ) {
    }

    /**
     * @param string[] $filePattern
     */
    public function doesFileInfoMatchPatterns(SmartFileInfo $smartFileInfo, array $filePattern): bool
    {
        foreach ($filePattern as $onlyFile) {
            if ($this->doesFileInfoMatchPattern($smartFileInfo, $onlyFile)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Supports both relative and absolute $file path. They differ for PHP-CS-Fixer and PHP_CodeSniffer.
     */
    private function doesFileInfoMatchPattern(SmartFileInfo $smartFileInfo, string $ignoredPath): bool
    {
        // in ecs.php, the path can be absolute
        if ($smartFileInfo->getRealPath() === $ignoredPath) {
            return true;
        }

        $ignoredPath = $this->fnMatchPathNormalizer->normalizeForFnmatch($ignoredPath);
        if ($ignoredPath === '') {
            return false;
        }

        if ($smartFileInfo->startsWith($ignoredPath)) {
            return true;
        }

        if ($smartFileInfo->endsWith($ignoredPath)) {
            return true;
        }

        return $smartFileInfo->doesFnmatch($ignoredPath);
    }
}
