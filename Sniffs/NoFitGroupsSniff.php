<?php

namespace Graycore\PhpcsSniffs\Sniffs;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class NoFitGroupsSniff implements Sniff
{
    public $supportedTokenizers = array(
        'PHP',
    );

    /**
     * @inheritdoc
     */
    public function register()
    {
        return array(\T_DOC_COMMENT_TAG);
    }

    /**
     * @inheritdoc
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        if (
            $phpcsFile->getTokens()[$stackPtr]['content'] === '@group' &&
            $phpcsFile->getTokens()[$stackPtr + 2]['content'] === 'fit'
        ) {
            $line = $phpcsFile->getTokens()[$stackPtr]['line'];
            $error = "@group fit discovered on line ${line}";
            $phpcsFile->addError($error, $stackPtr, 'GroupFit');
        }
    }
}
