<?php

if (!function_exists('mapping_item')) {
    function mapping_item(string $raw): array
    {
        $parts = explode('|', $raw);
        $taskName = trim($parts[0]);
        $tagString = isset($parts[1]) ? trim($parts[1]) : '';

        return [
            'taskName' => $taskName,
            'tagString' => $tagString,
        ];
    }
}
