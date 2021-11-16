<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment;

use CzProject\GitPhp\Commit;
use CzProject\GitPhp\Git as GitApi;

class GitEnvironment
{
    /**
     * @var \CzProject\GitPhp\GitRepository
     */
    private $gitApi;

    /**
     * @var \CzProject\GitPhp\Commit|null
     */
    private $lastCommit;

    /**
     * GitEnvironment constructor.
     *
     * @param \CzProject\GitPhp\Git $gitApi
     * @param string                $gitRepoPath
     */
    public function __construct(
        GitApi $gitApi,
        string $gitRepoPath
    ) {
        $this->gitApi = $gitApi->open($gitRepoPath);
    }

    /**
     * Get SHA
     *
     * @throws \CzProject\GitPhp\GitException
     * @return string
     */
    public function getSha(): string
    {
        return $this->getLastCommit()->getId()->toString();
    }

    /**
     * Get branch
     *
     * @throws \CzProject\GitPhp\GitException
     * @return string
     */
    public function getBranch(): string
    {
        return $this->gitApi->getCurrentBranchName();
    }

    /**
     * Get message
     *
     * @throws \CzProject\GitPhp\GitException
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->getLastCommit()->getBody();
    }

    /**
     * Get author name
     *
     * @throws \CzProject\GitPhp\GitException
     * @return string|null
     */
    public function getAuthorName(): ?string
    {
        return $this->getLastCommit()->getAuthorName();
    }

    /**
     * Get author email
     *
     * @throws \CzProject\GitPhp\GitException
     * @return string
     */
    public function getAuthorEmail(): string
    {
        return $this->getLastCommit()->getAuthorEmail();
    }

    /**
     * Get committed at
     *
     * @throws \CzProject\GitPhp\GitException
     * @return string
     */
    public function getCommittedAt(): string
    {
        return $this->getLastCommit()->getCommitterDate()->format('Y-m-d');
    }

    /**
     * Get committer name
     *
     * @throws \CzProject\GitPhp\GitException
     * @return string|null
     */
    public function getCommitterName(): ?string
    {
        return $this->getLastCommit()->getCommitterName();
    }

    /**
     * Get committer email
     *
     * @throws \CzProject\GitPhp\GitException
     * @return string
     */
    public function getCommitterEmail(): string
    {
        return $this->getLastCommit()->getCommitterEmail();
    }

    /**
     * Get last commit
     *
     * @throws \CzProject\GitPhp\GitException
     * @return \CzProject\GitPhp\Commit
     */
    private function getLastCommit(): Commit
    {
        if (null !== $this->lastCommit) {
            return $this->lastCommit;
        }

        return $this->lastCommit = $this->gitApi->getLastCommit();
    }
}
