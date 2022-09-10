<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

use OndraM\CiDetector\Ci\AzurePipelines as CiDetectorAzurePipelines;
use tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType;

class AzurePipelines extends CiDetectorAzurePipelines implements CiTypeInterface
{
    /**
     * @inheritDoc
     */
    public function getPullRequest(): ?string
    {
        return (
            $this->env->get('SYSTEM_PULLREQUEST_PULLREQUESTID')
                ?: $this->env->get('SYSTEM_PULLREQUEST_PULLREQUESTNUMBER')
        ) ?: null;
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): string
    {
        return (string) CiType::AZURE_PIPELINES();
    }

    /**
     * @inheritDoc
     */
    public function getNonce(): ?string
    {
        return $this->env->get('SYSTEM_JOBID') ?: null;
    }
}
