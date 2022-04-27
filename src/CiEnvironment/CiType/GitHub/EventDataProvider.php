<?php

declare(strict_types=1);

namespace tr33m4n\CodeceptionModulePercyEnvironment\CiEnvironment\CiType\GitHub;

use JsonException;

class EventDataProvider
{
    /**
     * @var null|array<string, mixed>
     */
    private ?array $gitHubEventData = null;

    /**
     * Get event data
     *
     * @param string $path
     * @return mixed|null|mixed[]
     */
    public function get(string $path)
    {
        $this->populateEventData();

        if (array_key_exists($path, $this->gitHubEventData ?? []) || strpos($path, '.') === false) {
            return $this->gitHubEventData[$path] ?? null;
        }

        $output = $this->gitHubEventData ?? [];
        foreach (explode('.', $path) as $segment) {
            if (!array_key_exists($segment, $output)) {
                return null;
            }

            if (is_array($output[$segment])) {
                $output = $output[$segment];
            }
        }

        return $output;
    }

    /**
     * Populate event data
     */
    private function populateEventData(): void
    {
        if (null !== $this->gitHubEventData) {
            return;
        }

        if (!isset($_ENV['GITHUB_EVENT_PATH']) || !is_file($_ENV['GITHUB_EVENT_PATH'])) {
            $this->gitHubEventData = [];

            return;
        }

        try {
            /** @var array<string, mixed> $eventData */
            $eventData = json_decode(
                file_get_contents($_ENV['GITHUB_EVENT_PATH']) ?: '[]',
                true,
                512,
                JSON_THROW_ON_ERROR
            );

            $this->gitHubEventData = $eventData;
        } catch (JsonException $jsonException) {
            $this->gitHubEventData = [];
        }
    }
}
