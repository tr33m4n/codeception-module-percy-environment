<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;
use OndraM\CiDetector\Ci\TeamCity as CiDetectorTeamCity;

class TeamCity extends CiDetectorTeamCity implements CiTypeInterface
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
        return (string) CiType::TEAMCITY();
    }

    /**
     * @inheritDoc
     */
    public function getNonce(): ?string
    {
        return $this->env->get('BUILD_NUMBER') ?: null;
    }
}
