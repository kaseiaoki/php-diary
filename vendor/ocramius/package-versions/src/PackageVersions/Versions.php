<?php

namespace PackageVersions;

/**
 * This class is generated by ocramius/package-versions, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 */
final class Versions
{
    const ROOT_PACKAGE_NAME = '__root__';
    const VERSIONS = array (
  'composer/xdebug-handler' => '1.1.0@c919dc6c62e221fc6406f861ea13433c0aa24f08',
  'jean85/pretty-package-versions' => '1.2@75c7effcf3f77501d0e0caa75111aff4daa0dd48',
  'nette/bootstrap' => 'v2.4.6@268816e3f1bb7426c3a4ceec2bd38a036b532543',
  'nette/di' => 'v2.4.13@3f8f212b02d5c17feb97a7e0a39ab306f40c06ca',
  'nette/finder' => 'v2.4.2@ee951a656cb8ac622e5dd33474a01fd2470505a0',
  'nette/neon' => 'v2.4.3@5e72b1dd3e2d34f0863c5561139a19df6a1ef398',
  'nette/php-generator' => 'v3.0.5@ea90209c2e8a7cd087b2742ca553c047a8df5eff',
  'nette/robot-loader' => 'v3.0.4@3cf88781a05e0bf4618ae605361afcbaa4d5b392',
  'nette/utils' => 'v2.5.2@183069866dc477fcfbac393ed486aaa6d93d19a5',
  'nikic/php-parser' => 'v4.0.3@bd088dc940a418f09cda079a9b5c7c478890fb8d',
  'ocramius/package-versions' => '1.3.0@4489d5002c49d55576fa0ba786f42dbb009be46f',
  'phpstan/phpdoc-parser' => '0.3@ed3223362174b8067729930439e139794e9e514a',
  'phpstan/phpstan' => '0.10.3@dc62f78c9aa6e9f7c44e8d6518f1123cd1e1b1c0',
  'psr/log' => '1.0.2@4ebe3a8bf773a19edfe0a84b6585ba3d401b724d',
  'symfony/console' => 'v4.1.3@ca80b8ced97cf07390078b29773dc384c39eee1f',
  'symfony/finder' => 'v4.1.3@e162f1df3102d0b7472805a5a9d5db9fcf0a8068',
  'symfony/polyfill-mbstring' => 'v1.9.0@d0cd638f4634c16d8df4508e847f14e9e43168b8',
  '__root__' => 'dev-master@5319987a7c5242018d5ecc24d05da64de4863c88',
);

    private function __construct()
    {
    }

    /**
     * @throws \OutOfBoundsException if a version cannot be located
     */
    public static function getVersion(string $packageName) : string
    {
        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new \OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: cannot detect its version'
        );
    }
}
