<?php

namespace {

    WP_Mock::bootstrap();
}

namespace {

    class WP_Post_Type
    {
        public function __construct(
            public string $name,
            public string $label
        ) {
        }
    }
}
