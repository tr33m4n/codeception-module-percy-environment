<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment;

use Codeception\Module\WebDriver;
use Composer\InstalledVersions;
use tr33m4n\CodeceptionModulePercyEnvironment\Exception\EnvironmentException;

class EnvironmentProvider
{
    private CiEnvironment $ciEnvironment;

    private GitEnvironment $gitEnvironment;

    private PercyEnvironment $percyEnvironment;

    private WebDriver $webDriver;

    private string $packageName;

    /**
     * Provider constructor.
     *
     * @param \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment    $ciEnvironment
     * @param \tr33m4n\CodeceptionModulePercyEnvironment\GitEnvironment   $gitEnvironment
     * @param \tr33m4n\CodeceptionModulePercyEnvironment\PercyEnvironment $percyEnvironment
     * @param \Codeception\Module\WebDriver                               $webDriver
     * @param string                                                      $packageName
     */
    public function __construct(
        CiEnvironment $ciEnvironment,
        GitEnvironment $gitEnvironment,
        PercyEnvironment $percyEnvironment,
        WebDriver $webDriver,
        string $packageName
    ) {
        $this->ciEnvironment = $ciEnvironment;
        $this->gitEnvironment = $gitEnvironment;
        $this->percyEnvironment = $percyEnvironment;
        $this->webDriver = $webDriver;
        $this->packageName = $packageName;
    }

    /**
     * Get CI environment
     *
     * @return \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment
     */
    public function getCiEnvironment(): CiEnvironment
    {
        return $this->ciEnvironment;
    }

    /**
     * Get Git environment
     *
     * @return \tr33m4n\CodeceptionModulePercyEnvironment\GitEnvironment
     */
    public function getGitEnvironment(): GitEnvironment
    {
        return $this->gitEnvironment;
    }

    /**
     * Get percy environment
     *
     * @return \tr33m4n\CodeceptionModulePercyEnvironment\PercyEnvironment
     */
    public function getPercyEnvironment(): PercyEnvironment
    {
        return $this->percyEnvironment;
    }

    /**
     * Get environment info
     *
     * @throws \tr33m4n\CodeceptionModulePercyEnvironment\Exception\EnvironmentException
     * @return string
     */
    public function getEnvironmentInfo(): string
    {
        if (null === $this->webDriver->webDriver) {
            throw new EnvironmentException('Remote web driver is not available');
        }

        $webDriverCapabilities = $this->webDriver->webDriver->getCapabilities();

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
            ltrim(strstr($this->packageName, '/') ?: '', '/'),
            InstalledVersions::getVersion($this->packageName)
        );
    }

    /**
     * Get user agent
     *
     * @throws \tr33m4n\CodeceptionModulePercyEnvironment\Exception\EnvironmentException
     * @return string
     */
    public function getUserAgent(): string
    {
        return sprintf('%s (%s)', $this->getClientInfo(), $this->getEnvironmentInfo());
    }
}
