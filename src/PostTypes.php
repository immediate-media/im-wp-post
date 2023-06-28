<?php

declare(strict_types=1);

namespace IM\Fabric\Package\WpPost;

class PostTypes
{
    public function getAllPublicTypes(): array
    {
        $postTypes = get_post_types(['public' => true]);

        sort($postTypes);

        return array_values($postTypes);
    }

    public function getCustomPublicTypes(): array
    {
        $postTypes = get_post_types(['public' => true, '_builtin' => false]);

        sort($postTypes);

        return array_values($postTypes);
    }

    public function getWordpressDefaultPublicTypes(): array
    {
        $postTypes = get_post_types(['public' => true, '_builtin' => true]);

        sort($postTypes);

        return array_values($postTypes);
    }

    public function removeIgnoredPostTypes(array $postTypes, array $ignoredPostTypes): array
    {
        return array_values(array_diff($postTypes, $ignoredPostTypes));
    }
}
