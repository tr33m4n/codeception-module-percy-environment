<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;
use OndraM\CiDetector\Ci\SourceHut as CiDetectorSourceHut;

class SourceHut extends CiDetectorSourceHut implements CiTypeInterface
{
    /**
     * @inheritDoc
     */
    public function getPullRequest(): ?string
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): string
    {
        return CiType::SOURCEHUT->value;
    }

    /**
     * @inheritDoc
     */
    public function getNonce(): ?string
    {
        return $this->env->get('JOB_ID') ?: null;
    }
}
