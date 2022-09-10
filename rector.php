<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfReturnToEarlyReturnRector;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(SetList::DEAD_CODE);
    $rectorConfig->import(SetList::EARLY_RETURN);
    $rectorConfig->import(SetList::CODE_QUALITY);
    $rectorConfig->import(SetList::TYPE_DECLARATION);
    $rectorConfig->import(SetList::TYPE_DECLARATION_STRICT);
    $rectorConfig->import(SetList::PHP_74);

    $rectorConfig->paths([__DIR__ . '/src']);
    $rectorConfig->skip([
        ChangeOrIfReturnToEarlyReturnRector::class
    ]);
};
