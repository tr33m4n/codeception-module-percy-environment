<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;
use OndraM\CiDetector\Ci\Travis as CiDetectorTravis;

class Travis extends CiDetectorTravis implements CiTypeInterface
{
    /**
     * @inheritDoc
     */
    public function getPullRequest(): ?string
    {
        return $this->env->get('TRAVIS_PULL_REQUEST') && $this->env->get('TRAVIS_PULL_REQUEST') !== 'false'
            ? $this->env->get('TRAVIS_PULL_REQUEST')
            : null;
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): string
    {
        return (string) CiType::TRAVIS();
    }

    /**
     * @inheritDoc
     */
    public function getNonce(): ?string
    {
        return $this->env->get('TRAVIS_BUILD_NUMBER') ?: null;
    }
}
