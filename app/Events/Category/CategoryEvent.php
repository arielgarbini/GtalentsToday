<?php

namespace Vanguard\Events\Category;

use Vanguard\Category;

abstract class CategoryEvent
{
    /**
     * @var Category
     */
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
