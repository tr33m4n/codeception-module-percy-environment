<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment;

interface EnvironmentProviderInterface
{
    /**
     * Get CI environment
     */
    public function getCiEnvironment(): CiEnvironment;

    /**
     * Get Git environment
     */
    public function getGitEnvironment(): GitEnvironment;

    /**
     * Get percy environment
     */
    public function getPercyEnvironment(): PercyEnvironment;

    /**
     * Get environment info
     *
     * @throws \tr33m4n\CodeceptionModulePercyEnvironment\Exception\EnvironmentException
     */
    public function getEnvironmentInfo(): string;

    /**
     * Get client info
     */
    public function getClientInfo(): string;

    /**
     * Get user agent
     *
     * @throws \tr33m4n\CodeceptionModulePercyEnvironment\Exception\EnvironmentException
     */
    public function getUserAgent(): string;
}
