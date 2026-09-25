<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\CiTypeInterface;
use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\Exception\InvalidCiException;

readonly class CiTypePool
{
    /**
     * CiTypePool constructor.
     *
     * @param array<string, \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\CiTypeInterface> $ciTypes
     */
    public function __construct(
        private array $ciTypes = []
    ) {
    }

    /**
     * Get CI type
     *
     * @throws \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\Exception\InvalidCiException
     */
    public function getCiType(CiType $ciType): CiTypeInterface
    {
        if (!array_key_exists($ciType->value, $this->ciTypes)) {
            throw new InvalidCiException(sprintf('"%s" is not a valid CI type', $ciType->value));
        }

        return $this->ciTypes[$ciType->value];
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
