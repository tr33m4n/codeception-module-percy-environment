<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;
use OndraM\CiDetector\Ci\Bamboo as CiDetectorBamboo;

class Bamboo extends CiDetectorBamboo implements CiTypeInterface
{
    /**
     * @inheritDoc
     */
    public function getPullRequest(): ?string
    {
        return $this->env->get('bamboo_repository_pr_key') ?: null;
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): string
    {
        return (string) CiType::BAMBOO();
    }

    /**
     * @inheritDoc
     */
    public function getNonce(): ?string
    {
        return $this->env->get('bamboo_buildNumber') ?: null;
    }
}
