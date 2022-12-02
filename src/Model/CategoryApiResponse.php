<?php

namespace App\Model;

class CategoryApiResponse
{
    /**
     * @var CategoryApiResponseItem[]
     */

    private array $items;

    /**
     * @param CategoryApiResponseItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return CategoryApiResponseItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
