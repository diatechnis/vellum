<?php

namespace Vellum\Helpers;

/**
 * @param array $first
 * @param array $second
 * @return array
 */
function recursive_array_merge(array $first, array $second)
{
    foreach ($first as $key1 => $value1) {
        if (!isset($second[$key1])) {
            $second[$key1] = $value1;
            continue;
        }
        // Both arrays have the same key...
        if (\is_array($value1)) {
            $second[$key1] = recursive_array_merge($value1, $second[$key1]);
        }
    }

    return $second;
}
