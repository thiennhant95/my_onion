<?php 
    if (isset($header_meta) && !empty($header_meta)) {
        foreach ($header_meta as $key => $value) {
            echo sprintf('<meta name="%s" content="%s" />', $key, $value) . "\n";
        }
    }
