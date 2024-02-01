<?php

namespace Giantpeach\Schnapps\Query;

class Pagination
{
  public int $total_pages;

  public function __construct($query)
  {
    if (!$query) {
      return null;
    }

    $this->total_pages = intval($query->max_num_pages);
  }
}
