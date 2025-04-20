<?php

namespace Tests\Unit;

use App\Models\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_name_true_is_true(): void
    {
        $categoryName = "Men";
        $this->assertTrue($categoryName == "Men");
    }
}
