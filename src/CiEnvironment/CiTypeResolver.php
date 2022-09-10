<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\CiTypeInterface;
use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\Unknown;
use OndraM\CiDetector\Env as CiDetectorEnv;

class CiTypeResolver
{
    private CiTypePool $ciTypePool;

    private CiDetectorEnv $ciDetectorEnv;

    /**
     * CiTypeResolver constructor.
     */
    public function __construct(
        CiTypePool $ciTypePool,
        CiDetectorEnv $ciDetectorEnv
    ) {
        $this->ciTypePool = $ciTypePool;
        $this->ciDetectorEnv = $ciDetectorEnv;
    }

    /**
     * Resolve CI type
     */
    public function resolve(): CiTypeInterface
    {
        foreach ($this->ciTypePool->getCiTypes() as $ciType) {
            if (!$ciType->isDetected($this->ciDetectorEnv)) {
                continue;
            }

            return $ciType;
        }

        return new Unknown();
    }
}
