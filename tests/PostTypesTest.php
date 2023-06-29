<?php

declare(strict_types=1);

namespace IM\Fabric\Package\WpPost\Test;

use IM\Fabric\Package\WpPost\PostTypes;
use PHPUnit\Framework\TestCase;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use WP_Mock;
use WP_Post_Type;

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
            'args' => [['public' => true], 'objects'],
            'return' => [
                'post' => new WP_Post_Type('post', 'Articles'),
                'how_to' => new WP_Post_Type('how_to', 'How To'),
            ],
        ]);

        $expected = ['Articles' => 'post', 'How To' => 'how_to'];
        $this->assertSame($expected, $this->unit->getAllPublicTypes());
    }

    public function testGetEditorialPostTypes()
    {
        WP_Mock::userFunction('get_post_types', [
            'times' => 1,
            'args' => [['public' => true], 'objects'],
            'return' => [
                'post' => new WP_Post_Type('post', 'Articles'),
                'how_to' => new WP_Post_Type('how_to', 'How To'),
                'attachment' => new WP_Post_Type('attachment', 'attachment'),
                'elementor_library' => new WP_Post_Type('elementor_library', 'elementor_library'),
                'e-landing-page' => new WP_Post_Type('e-landing-page', 'e-landing-page'),
            ],
        ]);

        $expected = ['Articles' => 'post', 'How To' => 'how_to'];
        $this->assertSame($expected, $this->unit->getEditorialPostTypes());
    }
}
