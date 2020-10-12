<?php
declare(strict_types=1);

namespace VU\OpenGraph\Tags;

use VU\OpenGraph\Exceptions\OpenGraphException;
use VU\OpenGraph\TagFactory;

class Video extends TagFactory
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
    ];

    /**
     * @var array
     */
    protected $additionalAttributes = [];

    /**
     * @var array
     */
    protected $validAdditionalAttr = [
        'actor',
        'actor:role',
        'director',
        'writer',
        'duration',
        'release_date',
        'tag',
        'series',
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
     * @return Video
     */
    public function setUrl(string $url): Video
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param array $attributes
     *
     * @throws OpenGraphException
     *
     * @return Image
     */
    public function setAttributes(array $attributes): Video
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
     * @param array $attributes
     *
     * @return Video
     */
    public function setAdditionalAttributes(array $attributes): Video
    {
        $validAttributes = $this->validAdditionalAttr;

        array_map(function ($key, $value) use ($validAttributes) {
            if (empty($key) || !in_array($key, $validAttributes)) {
                throw new OpenGraphException('Invalid values', 500);
            }
        }, array_keys($attributes), $attributes);

        $this->additionalAttributes = $attributes;

        return $this;
    }

    /**
     * @return array
     */
    public function getAdditionalAttributes(): array
    {
        return $this->additionalAttributes;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function rules(): array
    {
        return [];
    }

    public function handle()
    {
        parent::handle();

        $this->additional($this->attributes, self::OG_PREFIX . 'video:', true);
        $this->additional($this->additionalAttributes, 'video:', true);
    }
}
