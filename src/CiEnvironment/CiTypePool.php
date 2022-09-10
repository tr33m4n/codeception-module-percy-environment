<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\CiTypeInterface;
use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\Exception\InvalidCiException;

class CiTypePool
{
    /**
     * @var array<string, \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\CiTypeInterface>
     */
    private array $ciTypes;

    /**
     * CiTypePool constructor.
     *
     * @param array<string, \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\CiTypeInterface> $ciTypes
     */
    public function __construct(
        array $ciTypes = []
    ) {
        $this->ciTypes = $ciTypes;
    }

    /**
     * Get CI type
     *
     * @throws \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\Exception\InvalidCiException
     */
    public function getCiType(CiType $ciType): CiTypeInterface
    {
        if (!array_key_exists((string) $ciType, $this->ciTypes)) {
            throw new InvalidCiException(sprintf('"%s" is not a valid CI type', (string) $ciType));
        }

        return $this->ciTypes[(string) $ciType];
    }

    /**
     * Get CI types
     *
     * @return array<string, \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\CiTypeInterface>
     */
    public function getCiTypes(): array
    {
        return $this->ciTypes;
    }
}
