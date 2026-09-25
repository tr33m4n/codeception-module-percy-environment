<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment;

enum CiType: string
{
    case TRAVIS = 'travis';
    case JENKINS = 'jenkins';
    case CIRCLE = 'circle';
    case CODESHIP = 'codeship';
    case DRONE = 'drone';
    case GITLAB = 'gitlab';
    case AZURE_PIPELINES = 'azure';
    case APPVEYOR = 'appveyor';
    case BITBUCKET_PIPELINES = 'bitbucket';
    case GITHUB_ACTIONS = 'github';
    case AWS_CODEBUILD = 'aws-codebuild';
    case BAMBOO = 'bamboo';
    case BUDDY = 'buddy';
    case CONTINUOUSPHP = 'continuousphp';
    case SOURCEHUT = 'sourcehut';
    case TEAMCITY = 'teamcity';
    case WERCKER = 'wercker';
    case UNKNOWN = 'CI/Unknown';
}
