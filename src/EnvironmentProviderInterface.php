<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment;

interface EnvironmentProviderInterface
{
    /**
     * Get CI environment
     *
     * @return \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment
     */
    public function getCiEnvironment(): CiEnvironment;

    /**
     * Get Git environment
     *
     * @return \tr33m4n\CodeceptionModulePercyEnvironment\GitEnvironment
     */
    public function getGitEnvironment(): GitEnvironment;

    /**
     * Get percy environment
     *
     * @return \tr33m4n\CodeceptionModulePercyEnvironment\PercyEnvironment
     */
    public function getPercyEnvironment(): PercyEnvironment;

    /**
     * Get environment info
     *
     * @throws \tr33m4n\CodeceptionModulePercyEnvironment\Exception\EnvironmentException
     * @return string
     */
    public function getEnvironmentInfo(): string;

    /**
     * Get client info
     *
     * @return string
     */
    public function getClientInfo(): string;

    /**
     * Get user agent
     *
     * @throws \tr33m4n\CodeceptionModulePercyEnvironment\Exception\EnvironmentException
     * @return string
     */
    public function getUserAgent(): string;
}
