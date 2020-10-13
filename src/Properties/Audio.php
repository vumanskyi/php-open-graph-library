<?php
declare(strict_types=1);

namespace VU\OpenGraph\Properties;

use VU\OpenGraph\Exceptions\OpenGraphException;
use VU\OpenGraph\PropertyFactory;

class Audio extends PropertyFactory
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

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            static::OG_PREFIX . 'audio',
        ];
    }

    public function handle()
    {
        if ($this->url) {
            $this->configuration->handle()->render([
                'property' => static::OG_PREFIX . 'audio',
                'content' => $this->getUrl(),
            ]);
        }

        $this->additional($this->attributes, static::OG_PREFIX.'audio:', true);
    }
}
