<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;
use OndraM\CiDetector\Ci\GitLab as CiDetectorGitLab;

class GitLab extends CiDetectorGitLab implements CiTypeInterface
{
    /**
     * @inheritDoc
     */
    public function getPullRequest(): ?string
    {
        return ($this->env->get('CI_MERGE_REQUEST_IID') ?: $this->env->get('CI_EXTERNAL_PULL_REQUEST_IID')) ?: null;
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): string
    {
        return sprintf('%s/%s', (string) CiType::GITLAB(), $this->env->get('CI_SERVER_VERSION') ?: '');
    }

    /**
     * @inheritDoc
     */
    public function getNonce(): ?string
    {
        return $this->env->get('CI_PIPELINE_ID') ?: null;
    }
}
