<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment;

use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\CiTypeInterface;
use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\Unknown;
use OndraM\CiDetector\Env as CiDetectorEnv;

class CiTypeResolver
{
    /**
     * @var \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiTypePool
     */
    private $ciTypePool;

    /**
     * @var \OndraM\CiDetector\Env
     */
    private $ciDetectorEnv;

    /**
     * CiTypeResolver constructor.
     *
     * @param \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiTypePool $ciTypePool
     * @param \OndraM\CiDetector\Env                                    $ciDetectorEnv
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
     *
     * @return \tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\CiTypeInterface
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
