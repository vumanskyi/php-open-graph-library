<?php
declare(strict_types=1);

namespace Tests\Unit\Properties;

use PHPUnit\Framework\TestCase;
use VU\OpenGraph\Exceptions\OpenGraphException;
use VU\OpenGraph\Render;
use VU\OpenGraph\PropertyConfiguration;
use VU\OpenGraph\Properties\Profile;

class ProfileTest extends TestCase
{
    protected $config;

    public function setUp(): void
    {
        $render = new Render();
        $this->config = new PropertyConfiguration($render);
    }

    /**
     * @test
     */
    public function it_getters_setters()
    {
        $profile = new Profile($this->config);

        $firstName = 'John';
        $lastName = 'Doe';
        $username = 'john_doe';
        $gender = 'Male';

        $profile->setFirstName($firstName)
            ->setLastName($lastName)
            ->setUsername($username)
            ->setGender($gender);

        $this->assertSame($firstName, $profile->getFirstName());
        $this->assertSame($lastName, $profile->getLastName());
        $this->assertSame($username, $profile->getUsername());
        $this->assertSame(strtolower($gender), $profile->getGender());
    }

    /**
     * @test
     */
    public function it_setter_gender_failure()
    {
        $profile = new Profile($this->config);

        $this->expectException(OpenGraphException::class);
        $this->expectExceptionMessage('Invalid values');
        $this->expectExceptionCode(500);

        $profile->setGender('No');
    }

    /**
     * @test
     */
    public function it_rules()
    {
        $profile = new Profile($this->config);
        $this->assertEquals(['validGender'], $profile->rules());
    }

    /**
     * @test
     */
    public function it_handle()
    {
        $profile = new Profile($this->config);

        $firstName = 'John';
        $lastName = 'Doe';
        $username = 'john_doe';
        $gender = 'Male';

        $profile->setFirstName($firstName)
            ->setLastName($lastName)
            ->setUsername($username)
            ->setGender($gender)
            ->handle();

        $this->assertEquals('
<meta property="profile:first_name" content="John">
<meta property="profile:last_name" content="Doe">
<meta property="profile:username" content="john_doe">
<meta property="profile:gender" content="male">', $profile->render());
    }
}
