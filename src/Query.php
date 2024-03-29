<?php

namespace Giantpeach\Schnapps\Query;

class Query
{
  public static function getPosts(string $postType = 'post', int $perPage = 3, $args = [])
  {
    $defaults = [
      'post_type' => $postType,
      'posts_per_page' => $perPage,
    ];

    $args = array_merge($defaults, $args);

    $query = new \WP_Query($args);

    $posts = [];

    for ($i = 0; $i < $query->post_count; $i++) {
      $posts[] = new Post($query->posts[$i]);
    }

    return $posts;
  }

  /**
   * Get array with posts and pagination
   *
   * @return array
   */
  public static function getQueryResults(string $postType = 'post', int $perPage = 3, $args = [])
  {
    $defaults = [
      'post_type' => $postType,
      'posts_per_page' => $perPage,
    ];

    $args = array_merge($defaults, $args);

    $query = new \WP_Query($args);

    $posts = [];
    $pagination = [];

    for ($i = 0; $i < $query->post_count; $i++) {
      $posts[] = new Post($query->posts[$i]);
    }

    return [
      'posts' => $posts,
      'pagination' => new Pagination($query)
    ];
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
