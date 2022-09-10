<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

use OndraM\CiDetector\Ci\CiInterface;

interface CiTypeInterface extends CiInterface
{
    /**
     * Get pull request
     */
    public function getPullRequest(): ?string;

    /**
     * Get slug
     */
    public function getSlug(): string;

    /**
     * Get nonce
     */
    public function getNonce(): ?string;
}
