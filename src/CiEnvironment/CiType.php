<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment;

use MyCLabs\Enum\Enum;

// phpcs:disable PSR1.Methods.CamelCapsMethodName
// @phpstan-ignore-next-line
final class CiType extends Enum
{
    public const TRAVIS = 'travis';

    public const JENKINS = 'jenkins';

    public const CIRCLE = 'circle';

    public const CODESHIP = 'codeship';

    public const DRONE = 'drone';

    public const GITLAB = 'gitlab';

    public const AZURE_PIPELINES = 'azure';

    public const APPVEYOR = 'appveyor';

    public const BITBUCKET_PIPELINES = 'bitbucket';

    public const GITHUB_ACTIONS = 'github';

    public const AWS_CODEBUILD = 'aws-codebuild';

    public const BAMBOO = 'bamboo';

    public const BUDDY = 'buddy';

    public const CONTINUOUSPHP = 'continuousphp';

    public const SOURCEHUT = 'sourcehut';

    public const TEAMCITY = 'teamcity';

    public const WERCKER = 'wercker';

    public const UNKNOWN = 'CI/Unknown';

    public static function TRAVIS(): CiType
    {
        return self::from(self::TRAVIS);
    }

    public static function JENKINS(): CiType
    {
        return self::from(self::JENKINS);
    }

    public static function AWS_CODEBUILD(): CiType
    {
        return self::from(self::AWS_CODEBUILD);
    }

    public static function CIRCLE(): CiType
    {
        return self::from(self::CIRCLE);
    }

    public static function CODESHIP(): CiType
    {
        return self::from(self::CODESHIP);
    }

    public static function DRONE(): CiType
    {
        return self::from(self::DRONE);
    }

    public static function BAMBOO(): CiType
    {
        return self::from(self::BAMBOO);
    }

    public static function BUDDY(): CiType
    {
        return self::from(self::BUDDY);
    }

    public static function CONTINUOUSPHP(): CiType
    {
        return self::from(self::CONTINUOUSPHP);
    }

    public static function GITLAB(): CiType
    {
        return self::from(self::GITLAB);
    }

    public static function AZURE_PIPELINES(): CiType
    {
        return self::from(self::AZURE_PIPELINES);
    }

    public static function APPVEYOR(): CiType
    {
        return self::from(self::APPVEYOR);
    }

    public static function SOURCEHUT(): CiType
    {
        return self::from(self::SOURCEHUT);
    }

    public static function BITBUCKET_PIPELINES(): CiType
    {
        return self::from(self::BITBUCKET_PIPELINES);
    }

    public static function GITHUB_ACTIONS(): CiType
    {
        return self::from(self::GITHUB_ACTIONS);
    }

    public static function TEAMCITY(): CiType
    {
        return self::from(self::TEAMCITY);
    }

    public static function WERCKER(): CiType
    {
        return self::from(self::WERCKER);
    }

    public static function UNKNOWN(): CiType
    {
        return self::from(self::UNKNOWN);
    }
}
