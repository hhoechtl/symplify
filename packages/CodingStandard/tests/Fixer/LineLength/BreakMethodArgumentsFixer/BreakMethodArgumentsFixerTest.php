<?php declare(strict_types=1);

namespace Symplify\CodingStandard\Tests\Fixer\LineLength\BreakMethodArgumentsFixer;

use PhpCsFixer\Fixer\FixerInterface;
use Symplify\CodingStandard\Fixer\LineLength\BreakMethodArgumentsFixer;
use Symplify\EasyCodingStandard\Testing\AbstractContainerAwareCheckerTestCase;

/**
 * @covers \Symplify\CodingStandard\Fixer\LineLength\BreakMethodArgumentsFixer
 */
final class BreakMethodArgumentsFixerTest extends AbstractContainerAwareCheckerTestCase
{
    /**
     * @dataProvider provideCorrectCases()
     */
    public function testCorrectCases(string $file): void
    {
        $this->doTestCorrectFile($file);
    }

    /**
     * @return string[][]
     */
    public function provideCorrectCases(): array
    {
        return [
            [__DIR__ . '/correct/correct.php.inc'],
        ];
    }

    /**
     * @dataProvider wrongToFixedCases()
     */
    public function test(string $wrongFile, string $fixedFile): void
    {
        $this->doTestWrongToFixedFile($wrongFile, $fixedFile);
    }

    /**
     * @return string[][]
     */
    public function wrongToFixedCases(): array
    {
        return [
            [__DIR__ . '/wrong/wrong.php.inc', __DIR__ . '/fixed/fixed.php.inc'],
            [__DIR__ . '/wrong/wrong2.php.inc', __DIR__ . '/fixed/fixed2.php.inc'],
        ];
    }

    protected function provideConfig(): string
    {
        return __DIR__ . '/config.yml';
    }
}
