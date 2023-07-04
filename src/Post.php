<?php

namespace Giantpeach\Schnapps\Query;

class Post
{
  public string $title;
  public string $content;
  public string $link;
  public string $image;
  public string $date;
  public string $author;
  public array $categories;
  public string $excerpt;
  public string $slug;
  public string $type;
  public string $status;
  public string $id;
  public string $name;
  public string $parent;
  public string $menu_order;
  public string $comment_status;
  public string $ping_status;
  public string $template;
  public array $meta;
  public string $acf;

  public function __construct($post)
  {
    $this->title = $post->post_title;
    $this->content = $post->post_content;
    $this->link = \get_permalink($post->ID);
    $this->image = \get_the_post_thumbnail_url($post->ID);
    $this->date = $post->post_date;
    $this->author = $post->post_author;
    $this->categories = \get_the_category($post->ID);
    $this->excerpt = $post->post_excerpt;
    $this->slug = $post->post_name;
    $this->type = $post->post_type;
    $this->status = $post->post_status;
    $this->id = $post->ID;
    $this->name = $post->post_name;
    $this->parent = $post->post_parent;
    $this->menu_order = $post->menu_order;
    $this->comment_status = $post->comment_status;
    $this->ping_status = $post->ping_status;
    $this->template = $post->template;
    $this->meta = \get_post_meta($post->ID);
    $this->acf = \get_fields($post->ID);
  }

  private function getImageUrl($postId)
  {
    if (class_exists('\Giantpeach\Schnapps\Images\Images')) {
      $id = \get_post_thumbnail_id($postId);
      return \Giantpeach\Schnapps\Images\Images::getInstance()->getGlideImageUrl($id);
    }

    return \get_the_post_thumbnail_url($postId);
  }
}
