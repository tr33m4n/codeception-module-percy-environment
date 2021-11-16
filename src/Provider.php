<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiEnvironment;
use tr33m4n\CodeceptionModulePercyEnvironment\GitEnvironment\GitEnvironment;
use tr33m4n\CodeceptionModulePercyEnvironment\PercyEnvironment\PercyEnvironment;
use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\Exception\InvalidCiException;
use Codeception\Module\WebDriver;
use PackageVersions\Versions;

class Provider
{
    public const PACKAGE_NAME = 'tr33m4n/codeception-module-percy';

    /**
     * @var \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiEnvironment
     */
    private $ciEnvironment;

    /**
     * @var \tr33m4n\CodeceptionModulePercyEnvironment\GitEnvironment\GitEnvironment
     */
    private $gitEnvironment;

    /**
     * @var \tr33m4n\CodeceptionModulePercyEnvironment\PercyEnvironment\PercyEnvironment
     */
    private $percyEnvironment;

    /**
     * Provider constructor.
     *
     * @param \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiEnvironment       $ciEnvironment
     * @param \tr33m4n\CodeceptionModulePercyEnvironment\GitEnvironment\GitEnvironment     $gitEnvironment
     * @param \tr33m4n\CodeceptionModulePercyEnvironment\PercyEnvironment\PercyEnvironment $percyEnvironment
     */
    public function __construct(
        CiEnvironment $ciEnvironment,
        GitEnvironment $gitEnvironment,
        PercyEnvironment $percyEnvironment
    ) {
        $this->ciEnvironment = $ciEnvironment;
        $this->gitEnvironment = $gitEnvironment;
        $this->percyEnvironment = $percyEnvironment;
    }

    /**
     * Get CI environment
     *
     * @return \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiEnvironment
     */
    public function getCiEnvironment(): CiEnvironment
    {
        return $this->ciEnvironment;
    }

    /**
     * Get Git environment
     *
     * @return \tr33m4n\CodeceptionModulePercyEnvironment\GitEnvironment\GitEnvironment
     */
    public function getGitEnvironment(): GitEnvironment
    {
        return $this->gitEnvironment;
    }

    /**
     * Get percy environment
     *
     * @return \tr33m4n\CodeceptionModulePercyEnvironment\PercyEnvironment\PercyEnvironment
     */
    public function getPercyEnvironment(): PercyEnvironment
    {
        return $this->percyEnvironment;
    }

    /**
     * Get environment info
     *
     * @throws \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\Exception\InvalidCiException
     * @throws \tr33m4n\Utilities\Exception\AdapterException
     * @return string
     */
    public function getEnvironmentInfo(): string
    {
        $webDriver = config('webDriver');
        if (!$webDriver instanceof WebDriver) {
            throw new InvalidCiException('Web driver has not been configured');
        }

        $webDriverCapabilities = $webDriver->webDriver->getCapabilities();

        $environmentInfo[] = sprintf(
            'codeception-php; %s; %s/%s',
            $webDriverCapabilities->getPlatform(),
            $webDriverCapabilities->getBrowserName(),
            $webDriverCapabilities->getVersion()
        );

        $environmentInfo[] = sprintf('php/%s', phpversion());
        $environmentInfo[] = $this->getCiEnvironment()->getSlug();

        return implode('; ', $environmentInfo);
    }

    /**
     * Get client info
     *
     * @return string
     */
    public function getClientInfo(): string
    {
        return sprintf(
            '%s/%s',
            ltrim(strstr(self::PACKAGE_NAME, '/') ?: '', '/'),
            strstr(Versions::getVersion(self::PACKAGE_NAME), '@', true)
        );
    }

    /**
     * Get user agent
     *
     * @throws \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\Exception\InvalidCiException
     * @throws \tr33m4n\Utilities\Exception\AdapterException
     * @return string
     */
    public function getUserAgent(): string
    {
        return sprintf('%s (%s)', $this->getClientInfo(), $this->getEnvironmentInfo());
    }
}
