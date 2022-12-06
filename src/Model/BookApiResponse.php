<?php

namespace App\Model;

class BookApiResponse
{
    /**
     * @var BookApiResponseItem[]
     */

    private array $items;

    /**
     * @param BookApiResponseItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return BookApiResponseItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
