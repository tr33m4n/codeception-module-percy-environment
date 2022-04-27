<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;
use OndraM\CiDetector\Ci\BitbucketPipelines as CiDetectorBitbucketPipelines;

class BitbucketPipelines extends CiDetectorBitbucketPipelines implements CiTypeInterface
{
    /**
     * @inheritDoc
     */
    public function getPullRequest(): ?string
    {
        return $this->env->get('BITBUCKET_PR_ID') ?: null;
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): string
    {
        return (string) CiType::BITBUCKET_PIPELINES();
    }

    /**
     * @inheritDoc
     */
    public function getNonce(): ?string
    {
        return $this->env->get('BITBUCKET_BUILD_NUMBER') ?: null;
    }
}
