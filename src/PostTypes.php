<?php

declare(strict_types=1);

namespace IM\Fabric\Package\WpPost;

class PostTypes
{
    private const EXCLUDE_LIST = ['elementor_library', 'e-landing-page', 'attachment'];

    public function getAllPublicTypes(): array
    {
        $postTypes = get_post_types(['public' => true], 'objects');

        $out = [];
        foreach ($postTypes as $postTypeName => $postType) {
            $out[$postType->label] = $postTypeName;
        }

        return $out;
    }

    public function getEditorialPostTypes(): array
    {
        return array_filter($this->getAllPublicTypes(), fn($item) => !in_array($item, self::EXCLUDE_LIST));
    }
}
