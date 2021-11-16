<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;
use OndraM\CiDetector\Ci\AwsCodeBuild as CiDetectorAwsCodeBuild;

class AwsCodeBuild extends CiDetectorAwsCodeBuild implements CiTypeInterface
{
    /**
     * @inheritDoc
     */
    public function getPullRequest(): ?string
    {
        if (strpos($_ENV['CODEBUILD_WEBHOOK_EVENT'] ?? '', 'PULL_REQUEST') !== false) {
            return str_replace('pr/', '', $_ENV['CODEBUILD_SOURCE_VERSION'] ?? '');
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): string
    {
        return (string) CiType::AWS_CODEBUILD();
    }

    /**
     * @inheritDoc
     */
    public function getNonce(): ?string
    {
        return $_ENV['CODEBUILD_BUILD_ID'] ?? null;
    }
}
