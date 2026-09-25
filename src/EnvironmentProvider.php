<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment;

use Codeception\Module\WebDriver;
use Composer\InstalledVersions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverCapabilities;
use tr33m4n\CodeceptionModulePercyEnvironment\Exception\EnvironmentException;

readonly class EnvironmentProvider implements EnvironmentProviderInterface
{
    /**
     * Provider constructor.
     */
    public function __construct(
        private CiEnvironment $ciEnvironment,
        private GitEnvironment $gitEnvironment,
        private PercyEnvironment $percyEnvironment,
        private WebDriver $webDriver,
        private string $packageName
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getCiEnvironment(): CiEnvironment
    {
        return $this->ciEnvironment;
    }

    /**
     * @inheritDoc
     */
    public function getGitEnvironment(): GitEnvironment
    {
        return $this->gitEnvironment;
    }

    /**
     * @inheritDoc
     */
    public function getPercyEnvironment(): PercyEnvironment
    {
        return $this->percyEnvironment;
    }

    /**
     * @inheritDoc
     */
    public function getEnvironmentInfo(): string
    {
        $remoteWebDriver = $this->webDriver->webDriver;
        if (!$remoteWebDriver instanceof RemoteWebDriver) {
            throw new EnvironmentException('Remote web driver is not available');
        }

        $webDriverCapabilities = $remoteWebDriver->getCapabilities();
        if (!$webDriverCapabilities instanceof WebDriverCapabilities) {
            throw new EnvironmentException('Unable to get remote web driver capabilities');
        }

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
     * @inheritDoc
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
     * @inheritDoc
     */
    public function getUserAgent(): string
    {
        return sprintf('%s (%s)', $this->getClientInfo(), $this->getEnvironmentInfo());
    }
}
