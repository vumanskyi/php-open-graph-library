<?php
declare(strict_types=1);

namespace VU\OpenGraph\Tags;

use VU\OpenGraph\Exceptions\OpenGraphException;
use VU\OpenGraph\TagFactory;

class Image extends TagFactory
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
        'width',
        'height',
        'type',
        'alt',
    ];

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return Image
     */
    public function setUrl(string $url): Image
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param array $attributes
     *
     * @return Image
     */
    public function setAttributes(array $attributes): Image
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
     * @return string[]
     */
    public function rules(): array
    {
        return [static::OG_PREFIX . 'image:'];
    }

    public function handle()
    {
        if ($this->url) {
            $this->configuration->handle()->render([
                'property' => static::OG_PREFIX . 'image',
                'content' => $this->getUrl(),
            ]);
        }

        $this->additional($this->getAttributes(), static::OG_PREFIX . 'image:', true);
    }
}
