<?php
declare(strict_types=1);

namespace VU\OpenGraph\Tags;

use VU\OpenGraph\Exceptions\OpenGraphException;
use VU\OpenGraph\TagFactory;

class Audio extends TagFactory
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var array
     */
    protected $validAttributes = [
        'secure_url',
        'type',
    ];

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return Audio
     */
    public function setUrl(string $url): Audio
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param array $attributes
     *
     * @throws OpenGraphException
     *
     * @return Audio
     */
    public function setAttributes(array $attributes): Audio
    {
        $validAttributes = $this->validAttributes;

        array_map(function ($key, $value) use ($validAttributes) {
            if (empty($key) || !in_array($key, $validAttributes)) {
                throw new OpenGraphException('Invalid values', 500);
            }
        }, array_keys($attributes), $attributes);

        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function render()
    {
        //TODO - implementation
    }
}
