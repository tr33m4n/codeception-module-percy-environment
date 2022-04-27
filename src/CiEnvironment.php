<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\CiTypeInterface;
use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiTypeResolver;

class CiEnvironment
{
    private CiTypeInterface $ciType;

    /**
     * CiEnvironment constructor.
     *
     * @param \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiTypeResolver $ciTypeResolver
     */
    public function __construct(
        CiTypeResolver $ciTypeResolver
    ) {
        $this->ciType = $ciTypeResolver->resolve();
    }

    /**
     * Get pull request
     *
     * @return string|null
     */
    public function getPullRequest(): ?string
    {
        return $this->ciType->getPullRequest();
    }

    /**
     * Get branch
     *
     * @return string|null
     */
    public function getBranch(): ?string
    {
        return $this->ciType->getBranch();
    }

    /**
     * Get commit
     *
     * @return string|null
     */
    public function getCommit(): ?string
    {
        return $this->ciType->getCommit();
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
