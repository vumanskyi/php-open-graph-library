<?php
declare(strict_types=1);

namespace VU\OpenGraph;

abstract class TagFactory
{
    /**
     * @var string
     */
    const OG_PREFIX = 'og:';

    private $configuration;

    /**
     * TagFactory constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @var array
     */
    protected $rules = [];

    public function render()
    {
        $properties = get_object_vars($this);

        foreach ($properties as $property => $content) {
            if ($this->isExistProperty($property, $content)) {
                continue;
            }

            $this->configuration->handle()->render([
                'property'  => static::OG_PREFIX.$property,
                'content'   => $content,
            ]);

//            $this->getOpenGraph()->render([
//                'property'  => static::OG_PREFIX.$property,
//                'content'   => $content,
//            ]);
        }
    }

    /**
     * @param string $property
     * @param string $content
     * @return bool
     */
    public function isExistProperty(string $property, string $content): bool
    {
        return in_array($property, $this->rules) || empty($content);
    }
}
