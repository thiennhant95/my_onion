<?php 
    if (isset($header_ogp) && !empty($header_ogp)) {
        foreach ($header_ogp as $key => $value) {
            echo sprintf('<meta property="%s" content="%s" />', $key, $value) . "\n";
        }
    }
