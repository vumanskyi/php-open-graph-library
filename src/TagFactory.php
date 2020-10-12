<?php
declare(strict_types=1);

namespace VU\OpenGraph;

abstract class TagFactory
{
    /**
     * @var string
     */
    const OG_PREFIX = 'og:';

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @return string[]
     */
    abstract public function rules(): array;

    /**
     * TagFactory constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function handle()
    {
        $properties = get_object_vars($this);

        foreach ($properties as $property => $content) {
            if (is_array($content) || $this->isExistProperty($property, $content)) {
                continue;
            }

            $this->configuration->handle()->render([
                'property'  => static::OG_PREFIX.$property,
                'content'   => $content,
            ]);
        }
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->configuration->handle()->content();
    }

    /**
     * @param array  $data
     * @param string $prefixKey
     * @param bool   $useKey
     */
    public function additional(array $data = [], string $prefixKey, bool $useKey = false)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                continue;
            }

            $property = $useKey ? $prefixKey.$key : $prefixKey;

            $this->configuration->handle()->render([
                'property'  => $property,
                'content'   => $value,
            ]);
        }
    }

    /**
     * @param string $property
     * @param mixed $content
     * @return bool
     */
    public function isExistProperty(string $property, $content = null): bool
    {
        if (empty($content) || is_object($content)) {
            return true;
        }

        return in_array($property, $this->rules());
    }
}
