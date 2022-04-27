<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment;

use CzProject\GitPhp\Commit;
use CzProject\GitPhp\Git as GitApi;
use CzProject\GitPhp\GitRepository;

class GitEnvironment
{
    private GitRepository $gitRepository;

    private ?Commit $lastCommit = null;

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
        $this->gitRepository = $gitApi->open($gitRepoPath);
    }

    /**
     * Get SHA
     *
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
        return $this->gitRepository->getCurrentBranchName();
    }

    /**
     * Get message
     *
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->getLastCommit()->getBody();
    }

    /**
     * Get author name
     *
     * @return string|null
     */
    public function getAuthorName(): ?string
    {
        return $this->getLastCommit()->getAuthorName();
    }

    /**
     * Get author email
     *
     * @return string
     */
    public function getAuthorEmail(): string
    {
        return $this->getLastCommit()->getAuthorEmail();
    }

    /**
     * Get committed at
     *
     * @return string
     */
    public function getCommittedAt(): string
    {
        return $this->getLastCommit()->getCommitterDate()->format('Y-m-d');
    }

    /**
     * Get committer name
     *
     * @return string|null
     */
    public function getCommitterName(): ?string
    {
        return $this->getLastCommit()->getCommitterName();
    }

    /**
     * Get committer email
     *
     * @return string
     */
    public function getCommitterEmail(): string
    {
        return $this->getLastCommit()->getCommitterEmail();
    }

    /**
     * Get last commit
     *
     * @return \CzProject\GitPhp\Commit
     */
    private function getLastCommit(): Commit
    {
        if (null !== $this->lastCommit) {
            return $this->lastCommit;
        }

        return $this->lastCommit = $this->gitRepository->getLastCommit();
    }
}
