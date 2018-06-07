<?php
/**
 * @author mkelly
 * @date 6/6/18
 */

namespace Vellum\Path;


interface ClassPathInterface
{
    public function resolve(string $component_type, string $name): string;
}
