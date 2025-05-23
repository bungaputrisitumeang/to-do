<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class MappingHelperTest extends TestCase
{
    public function test_mapping_item_function()
    {
        $result = mapping_item("Buy Milk | dairy,urgent");

        $this->assertEquals('Buy Milk', $result['taskName']);
        $this->assertEquals('dairy,urgent', $result['tagString']);
    }

    public function test_mapping_item_without_tags()
    {
        $result = mapping_item("Go Jogging");

        $this->assertEquals('Go Jogging', $result['taskName']);
        $this->assertEquals('', $result['tagString']);
    }
}

