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
     */
    public function __construct(
        GitApi $gitApi,
        string $gitRepoPath
    ) {
        $this->gitRepository = $gitApi->open($gitRepoPath);
    }

    /**
     * Get SHA
     */
    public function getSha(): string
    {
        return $this->getLastCommit()->getId()->toString();
    }

    /**
     * Get branch
     *
     * @throws \CzProject\GitPhp\GitException
     */
    public function getBranch(): string
    {
        return $this->gitRepository->getCurrentBranchName();
    }

    /**
     * Get message
     */
    public function getMessage(): ?string
    {
        return $this->getLastCommit()->getBody();
    }

    /**
     * Get author name
     */
    public function getAuthorName(): ?string
    {
        return $this->getLastCommit()->getAuthorName();
    }

    /**
     * Get author email
     */
    public function getAuthorEmail(): string
    {
        return $this->getLastCommit()->getAuthorEmail();
    }

    /**
     * Get committed at
     */
    public function getCommittedAt(): string
    {
        return $this->getLastCommit()->getCommitterDate()->format('Y-m-d');
    }

    /**
     * Get committer name
     */
    public function getCommitterName(): ?string
    {
        return $this->getLastCommit()->getCommitterName();
    }

    /**
     * Get committer email
     */
    public function getCommitterEmail(): string
    {
        return $this->getLastCommit()->getCommitterEmail();
    }

    /**
     * Get last commit
     */
    private function getLastCommit(): Commit
    {
        if (null !== $this->lastCommit) {
            return $this->lastCommit;
        }

        return $this->lastCommit = $this->gitRepository->getLastCommit();
    }
}
