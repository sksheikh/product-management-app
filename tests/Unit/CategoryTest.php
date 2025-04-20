<?php

namespace Tests\Unit;

use App\Models\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_that_true_is_true(): void
    {
        $category = new Category(["Men", "Women", "Kids"]);
        $this->assertTrue($category->has("Men"));
        $this->assertFalse($category->has("Electronic"));
    }
}
