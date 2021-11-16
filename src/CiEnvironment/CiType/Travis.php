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
        return isset($_ENV['TRAVIS_PULL_REQUEST']) && $_ENV['TRAVIS_PULL_REQUEST'] !== 'false'
            ? $_ENV['TRAVIS_PULL_REQUEST']
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
        return $_ENV['TRAVIS_BUILD_NUMBER'] ?? null;
    }
}
