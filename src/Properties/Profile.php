<?php

declare(strict_types=1);

namespace VU\OpenGraph\Properties;

use VU\OpenGraph\Exceptions\OpenGraphException;
use VU\OpenGraph\PropertyFactory;

class Profile extends PropertyFactory
{
    /**
     * @var string
     */
    public const OG_PREFIX = 'profile:';

    /**
     * @var string
     */
    protected $first_name;

    /**
     * @var string
     */
    protected $last_name;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $gender;

    /**
     * @var array
     *
     * @see http://ogp.me/#type_profile
     */
    protected $validGender = [
        'male',
        'female',
    ];

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $first_name
     *
     * @return Profile
     */
    public function setFirstName(string $first_name): Profile
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * @param string $gender
     *
     * @throws OpenGraphException
     *
     * @return Profile
     */
    public function setGender(string $gender): Profile
    {
        if (!$this->isValidGender($gender)) {
            throw new OpenGraphException('Invalid values', 500);
        }

        $this->gender = strtolower($gender);

        return $this;
    }

    /**
     * @param string $last_name
     *
     * @return Profile
     */
    public function setLastName(string $last_name): Profile
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * @param string $username
     *
     * @return Profile
     */
    public function setUsername(string $username): Profile
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @param string $gender
     *
     * @return bool
     */
    protected function isValidGender(string $gender): bool
    {
        return in_array(strtolower($gender), $this->validGender);
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'validGender',
        ];
    }
}
