<?php

declare(strict_types=1);

namespace IM\Fabric\Package\WpPost\Test;

use IM\Fabric\Package\WpPost\PostTypes;
use PHPUnit\Framework\TestCase;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use WP_Mock;

class PostTypesTest extends TestCase
{
    private PostTypes $unit;

    public function setUp(): void
    {
        WP_Mock::setUp();
        $this->unit = new PostTypes();
    }

    public function testGetAllPublicTypes()
    {
        WP_Mock::userFunction('get_post_types', [
            'times' => 1,
            'args' => [['public' => true]],
            'return' => ['post' => 'post', 'offer' => 'offer'],
        ]);

        $expected = ['offer', 'post'];
        $this->assertSame($expected, $this->unit->getAllPublicTypes());
    }

    public function testGetCustomPublicTypes()
    {
        WP_Mock::userFunction('get_post_types', [
            'times' => 1,
            'args' => [['public' => true, '_builtin' => false]],
            'return' => ['post' => 'post', 'offer' => 'offer'],
        ]);

        $expected = ['offer', 'post'];
        $this->assertSame($expected, $this->unit->getCustomPublicTypes());
    }

    public function testGetWordpressDefaultPublicTypes()
    {
        WP_Mock::userFunction('get_post_types', [
            'times' => 1,
            'args' => [['public' => true, '_builtin' => true]],
            'return' => ['post' => 'post', 'offer' => 'offer'],
        ]);

        $expected = ['offer', 'post'];
        $this->assertSame($expected, $this->unit->getWordpressDefaultPublicTypes());
    }
}
