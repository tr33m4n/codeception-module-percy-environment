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
        if (str_contains($this->env->get('CODEBUILD_WEBHOOK_EVENT') ?: '', 'PULL_REQUEST')) {
            return str_replace('pr/', '', $this->env->get('CODEBUILD_SOURCE_VERSION') ?: '');
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): string
    {
        return CiType::AWS_CODEBUILD->value;
    }

    /**
     * @inheritDoc
     */
    public function getNonce(): ?string
    {
        return $this->env->get('CODEBUILD_BUILD_ID') ?: null;
    }
}
