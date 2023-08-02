<?php

namespace Giantpeach\Schnapps\Query;

class PostType
{
  public static function create($name, $args = [])
  {
    $defaults = [
      'public' => true,
      'has_archive' => true,
      'supports' => ['title', 'editor', 'thumbnail'],
    ];

    $args = array_merge($defaults, $args);

    \register_post_type($name, $args);
  }

  public static function createTaxonomy($name, $postTypes = [], $args = [])
  {
    $defaults = [
      'public' => true,
      'hierarchical' => true,
    ];

    $args = array_merge($defaults, $args);

    \register_taxonomy($name, $postTypes, $args);
  }
}
