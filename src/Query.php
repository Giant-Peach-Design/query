<?php

namespace Giantpeach\Schnapps\Query;

class Query
{
  public static function getPosts($args = [])
  {
    $defaults = [
      'post_type' => 'post',
      'posts_per_page' => 3,
    ];

    $args = array_merge($defaults, $args);

    $query = new \WP_Query($args);

    $posts = [];

    for ($i = 0; $i < $query->post_count; $i++) {
      $posts[] = new Post($query->posts[$i]);
    }

    return $posts;
  }

  public static function getPost($args = [])
  {
    $defaults = [
      'post_type' => 'post',
      'posts_per_page' => 1,
    ];

    $args = array_merge($defaults, $args);

    $query = new \WP_Query($args);

    $post = new Post($query->posts[0]);

    return $post;
  }
}
