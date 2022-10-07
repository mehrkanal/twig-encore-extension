<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Core\Configuration\Option;
use Rector\EarlyReturn\Rector\If_\RemoveAlwaysElseRector;
use Rector\Php73\Rector\FuncCall\SetCookieRector;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
    ]);

    // Define what rule sets will be applied
    $rectorConfig->import(SetList::PHP_52);
    $rectorConfig->import(SetList::PHP_53);
    $rectorConfig->import(SetList::PHP_54);
    $rectorConfig->import(SetList::PHP_55);
    $rectorConfig->import(SetList::PHP_56);
    $rectorConfig->import(SetList::PHP_70);
    $rectorConfig->import(SetList::PHP_71);
    $rectorConfig->import(SetList::PHP_72);
    $rectorConfig->import(SetList::PHP_73);
    $rectorConfig->import(SetList::PHP_74);
    $rectorConfig->import(SetList::PHP_80);
    $rectorConfig->import(SetList::CODE_QUALITY);
    $rectorConfig->import(SetList::DEAD_CODE);

    // register a single rule
    $rectorConfig->rule(AddVoidReturnTypeWhereNoReturnRector::class);
    $rectorConfig->rule(RemoveAlwaysElseRector::class);
    $rectorConfig->rule(TypedPropertyRector::class);

    $services = $rectorConfig->services();
    $services->remove(SetCookieRector::class);
};
