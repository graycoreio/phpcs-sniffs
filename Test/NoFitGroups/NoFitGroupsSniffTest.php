<?php

use Graycore\PhpcsSniffs\Sniffs\NoFitGroupsSniff;
use Graycore\Test\RunnerFactory;
use PHP_CodeSniffer\Files\LocalFile;
use PHPUnit\Framework\TestCase;

class NoFitGroupsSniffTest extends TestCase
{
    public function testItPassesAGoodFile()
    {
        $runner = RunnerFactory::create([
            NoFitGroupsSniff::class => NoFitGroupsSniff::class
        ]);

        $phpcsFile = new LocalFile(
            __DIR__ . '/spec/pass.php',
            $runner->ruleset,
            $runner->config
        );
        $phpcsFile->process();

        $this->assertEquals(count($phpcsFile->getErrors()), 0);
    }

    public function testItFailsABadFile()
    {
        $runner = RunnerFactory::create(
            [
                NoFitGroupsSniff::class => NoFitGroupsSniff::class
            ],
            ['annotations' => true]
        );

        $phpcsFile = new LocalFile(
            __DIR__ . '/spec/fail.php',
            $runner->ruleset,
            $runner->config
        );
        $phpcsFile->process();

        $this->assertEquals($phpcsFile->getErrors()[6][8][0]['message'], '@group fit discovered on line 6');
    }
}
