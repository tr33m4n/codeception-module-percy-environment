<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\CiTypeInterface;
use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiTypeResolver;

class CiEnvironment
{
    private CiTypeInterface $ciType;

    private PercyEnvironment $percyEnvironment;

    /**
     * CiEnvironment constructor.
     *
     * @param \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiTypeResolver $ciTypeResolver
     * @param \tr33m4n\CodeceptionModulePercyEnvironment\PercyEnvironment             $percyEnvironment
     */
    public function __construct(
        CiTypeResolver $ciTypeResolver,
        PercyEnvironment $percyEnvironment
    ) {
        $this->ciType = $ciTypeResolver->resolve();
        $this->percyEnvironment = $percyEnvironment;
    }

    /**
     * Get pull request
     *
     * @return string|null
     */
    public function getPullRequest(): ?string
    {
        return $this->percyEnvironment->getPullRequest() ?? $this->ciType->getPullRequest();
    }

    /**
     * Get branch
     *
     * @return string|null
     */
    public function getBranch(): ?string
    {
        return $this->percyEnvironment->getBranch() ?? $this->ciType->getBranch();
    }

    /**
     * Get commit
     *
     * @return string|null
     */
    public function getCommit(): ?string
    {
        return $this->percyEnvironment->getCommit() ?? $this->ciType->getCommit();
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->ciType->getSlug();
    }

    /**
     * Get nonce
     *
     * @return string|null
     */
    public function getNonce(): ?string
    {
        return $this->ciType->getNonce();
    }
}
