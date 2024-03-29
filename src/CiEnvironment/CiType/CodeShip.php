<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;
use OndraM\CiDetector\Ci\Codeship as CiDetectorCodeship;

class CodeShip extends CiDetectorCodeship implements CiTypeInterface
{
    /**
     * @inheritDoc
     */
    public function getPullRequest(): ?string
    {
        return $this->env->get('CI_PR_NUMBER') ?: null;
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): string
    {
        return (string) CiType::CODESHIP();
    }

    /**
     * @inheritDoc
     */
    public function getNonce(): ?string
    {
        return ($this->env->get('CI_BUILD_NUMBER') ?: $this->env->get('CI_BUILD_ID')) ?: null;
    }
}
