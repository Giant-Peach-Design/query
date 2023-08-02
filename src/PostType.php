<?php

namespace Giantpeach\Schnapps\Query;

class PostType
{
  /**
   * Create a custom post type
   *
   * @param [type] $name Singular name of the post type
   * @param array $args
   * @return void
   */
  public static function create($name, $args = [])
  {
    $defaults = [
      'public' => true,
      'has_archive' => true,
      'supports' => ['title', 'editor', 'thumbnail'],
      'show_in_rest' => true,
      'labels' => [
        'name' => ucfirst($name),
      ]
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
