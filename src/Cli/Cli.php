<?php

namespace Giantpeach\Schnapps\Query\Cli;

class Cli
{

  public function __construct()
  {
    add_action('cli_init', [$this, 'registerCommands']);
  }

  public function registerCommands()
  {
    \WP_CLI::add_command('create-post-type', [$this, 'create-post-type']);
  }


  public function createPostType($args, $assocArgs)
  {
    if (count($args) < 1) {
      \WP_CLI::error('Please provide a name for the Post Type');
    }

    \WP_CLI::success('Creating Post Type ' . $args[0]);

    $postTypeName = $args[0];
    $postTypeNameUpper = ucfirst($postTypeName);
    $postTypeNameLower = lcfirst($postTypeName);
    $postTypePath = get_template_directory() . '/src/PostTypes/';
    $postTypeFileName = $postTypeName . '.php';

    if (!file_exists($postTypePath . $postTypeFileName)) {


      $postTypeClass = <<<EOT
      <?php

      namespace Giantpeach\Schnapps\Theme\PostTypes;

      use Giantpeach\Schnapps\Query\PostType;
      use Giantpeach\Schnapps\Query\Query;
      use Giantpeach\Schnapps\Twiglet\Twiglet;

      use WP_REST_Request;

      class $postTypeName
      {
        public function __construct()
        {
          PostType::create('$postTypeNameLower');

          //PostType::createTaxonomy('taxonomy_name', ['$postTypeNameLower']);
        }

        // Add ajax handling here, you'll need to set up the routes in src/Routes/Api.php
        //public static function get(int \$perPage = 8, int \$page = 1): array
        //{
        //  \$posts = Query::getPosts('$postTypeNameLower', \$perPage, [
        //    'page' => \$page,
        //    'post_status' => 'publish',
        //    'orderby' => 'date',
        //    'order' => 'DESC',
        //  ]);

        //// do stuff with the posts here, e.g. get the thumbnail image url

        //return \$posts;
        //}

        //public static function getPage(\$page = 2)
        //{
        //  \$posts = self::get(8, \$page);

        //  Twiglet::getInstance()->display("src/Blocks/WorkList/items.twig", [
        //    'posts' => \$posts
        //  ]);
        //}

        //public static function getPageRequest(WP_REST_Request \$request)
        //{
        //  \$page = \$request->get_param('page') ?? 2;
        //  \$posts = self::getPage(\$page);

        //  if (\$posts) {
        //    return \$posts;
        //  }

        //  return;
        //}
      }
      EOT;

      file_put_contents($postTypePath . $postTypeFileName, $postTypeClass);

      \WP_CLI::success('Post Type class created');
    } else {
      \WP_CLI::error('Post Type class already exists');
    }

    \WP_CLI::success('Post Type created');
    \WP_CLI::success('Don\'t forget to register the Post Type in src/Schnapps.php');
  }
}
