<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;
use OndraM\CiDetector\Ci\Circle as CiDetectorCircle;

class Circle extends CiDetectorCircle implements CiTypeInterface
{
    /**
     * @inheritDoc
     */
    public function getPullRequest(): ?string
    {
        if (!$this->env->get('CIRCLE_PULL_REQUEST')) {
            return null;
        }

        $ciPullRequestsParts = explode('/', $this->env->get('CIRCLE_PULL_REQUEST'));
        return end($ciPullRequestsParts);
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): string
    {
        return (string) CiType::CIRCLE();
    }

    /**
     * @inheritDoc
     */
    public function getNonce(): ?string
    {
        return ($this->env->get('CIRCLE_WORKFLOW_ID') ?: $this->env->get('CIRCLE_BUILD_NUM')) ?: null;
    }
}
