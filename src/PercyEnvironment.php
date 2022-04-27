<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment;

class PercyEnvironment
{
    /**
     * Get pull request
     *
     * @return string|null
     */
    public function getPullRequest(): ?string
    {
        return getenv('PERCY_PULL_REQUEST') ?: null;
    }

    /**
     * Get branch
     *
     * @return string|null
     */
    public function getBranch(): ?string
    {
        return getenv('PERCY_BRANCH') ?: null;
    }

    /**
     * Get commit
     *
     * @return string|null
     */
    public function getCommit(): ?string
    {
        return getenv('PERCY_COMMIT') ?: null;
    }

    /**
     * Get target commit
     *
     * @return string|null
     */
    public function getTargetCommit(): ?string
    {
        return getenv('PERCY_TARGET_COMMIT') ?: null;
    }

    /**
     * Get target branch
     *
     * @return string|null
     */
    public function getTargetBranch(): ?string
    {
        return getenv('PERCY_TARGET_BRANCH') ?: null;
    }

    /**
     * Get parallel nonce
     *
     * @return string|null
     */
    public function getParallelNonce(): ?string
    {
        return getenv('PERCY_PARALLEL_NONCE') ?: null;
    }

    /**
     * Get parallel total
     *
     * @return int
     */
    public function getParallelTotal(): int
    {
        if (is_numeric(getenv('PERCY_PARALLEL_TOTAL'))) {
            return (int) getenv('PERCY_PARALLEL_TOTAL');
        }

        return 0;
    }

    /**
     * Get partial
     *
     * @return bool
     */
    public function getPartial(): bool
    {
        return getenv('PERCY_PARTIAL_BUILD') && getenv('PERCY_PARTIAL_BUILD') !== '0';
    }
}
