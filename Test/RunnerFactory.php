<?php

namespace Graycore\Test;

use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Runner;

require_once __DIR__ . '/../vendor/squizlabs/php_codesniffer/autoload.php';

class RunnerFactory
{
    public static function create(array $sniffs, array $settings = [])
    {
        $phpcs = new Runner();
        $config = new Config(['-q']);
        $config->setSettings(array_merge($config->getSettings(), $settings));
        $phpcs->config = $config;

        
        $phpcs->init();
        
        $phpcs->ruleset->sniffs = $sniffs;
        
        $phpcs->ruleset->populateTokenListeners();

        return $phpcs;
    }
}
