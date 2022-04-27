<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;
use OndraM\CiDetector\Ci\AppVeyor as CiDetectorAppVeyor;

class AppVeyor extends CiDetectorAppVeyor implements CiTypeInterface
{
    /**
     * @inheritDoc
     */
    public function getPullRequest(): ?string
    {
        return $this->env->get('APPVEYOR_PULL_REQUEST_NUMBER') ?: null;
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): string
    {
        return (string) CiType::APPVEYOR();
    }

    /**
     * @inheritDoc
     */
    public function getNonce(): ?string
    {
        return $this->env->get('APPVEYOR_BUILD_ID') ?: null;
    }
}
