<?php

use Rector\Core\Configuration\Option;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector;
use Rector\EarlyReturn\Rector\If_\ChangeAndIfToEarlyReturnRector;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfReturnToEarlyReturnRector;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\AddArrayParamDocTypeRector;
use Rector\TypeDeclaration\Rector\FunctionLike\ReturnTypeDeclarationRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(SetList::DEAD_CODE);
    $containerConfigurator->import(SetList::EARLY_RETURN);
    $containerConfigurator->import(SetList::CODE_QUALITY);
    $containerConfigurator->import(SetList::TYPE_DECLARATION);
    $containerConfigurator->import(SetList::TYPE_DECLARATION_STRICT);
    $containerConfigurator->import(SetList::PHP_74);

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [__DIR__ . '/src']);
    $parameters->set(Option::SKIP, [
        RemoveUselessParamTagRector::class,
        RemoveUselessReturnTagRector::class,
        ReturnTypeDeclarationRector::class,
        ChangeAndIfToEarlyReturnRector::class,
        ChangeOrIfReturnToEarlyReturnRector::class,
        AddArrayParamDocTypeRector::class => [
            __DIR__ . '/src/CiEnvironment/CiType/GitHub/EventDataProvider.php'
        ]
    ]);
};
