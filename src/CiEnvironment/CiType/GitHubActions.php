<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

use OndraM\CiDetector\Ci\GitHubActions as CiDetectorGitHubActions;
use OndraM\CiDetector\Env;
use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;
use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\GitHub\EventDataProvider;

class GitHubActions extends CiDetectorGitHubActions implements CiTypeInterface
{
    /**
     * @var \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\GitHub\EventDataProvider
     */
    private $eventDataProvider;

    /**
     * GitHub constructor.
     *
     * phpcs:disable Generic.Files.LineLength
     *
     * @param \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\GitHub\EventDataProvider $eventDataProvider
     * @param \OndraM\CiDetector\Env                                                                   $env
     */
    public function __construct(
        EventDataProvider $eventDataProvider,
        Env $env
    ) {
        $this->eventDataProvider = $eventDataProvider;

        parent::__construct($env);
    }

    /**
     * @inheritDoc
     */
    public function getPullRequest(): ?string
    {
        return $this->eventDataProvider->get('pull_request.number');
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): string
    {
        return isset($_ENV['PERCY_GITHUB_ACTION'])
            ? sprintf('%s/%s', (string) CiType::GITHUB_ACTIONS(), $_ENV['PERCY_GITHUB_ACTION'] ?? '')
            : (string) CiType::GITHUB_ACTIONS();
    }

    /**
     * @inheritDoc
     */
    public function getNonce(): ?string
    {
        return $_ENV['GITHUB_RUN_ID'] ?? null;
    }
}
