<?php 	include 'autoload.php'; ?>
<?php ini_set('display_errors', TRUE ); ?>
<?php

    $deviantid = 'inwebo';
    $galleryUrl = 'http://inwebo.deviantart.com/gallery/12613778';

    try {
        $DOMProfil    = new DOMDeviantProfil($deviantid);
        $parser       = new DeviantParser($DOMProfil);
        $version      = new DeviantVersion($DOMProfil);
        $profil       = new DeviantProfil($DOMProfil);
        $stats        = new DeviantStats($DOMProfil);
        $featured     = new DeviantFeatured($DOMProfil);
        $newest       = new DeviantNewest($DOMProfil);
        $favorites    = new DeviantFavorites($DOMProfil);

        $DOMGalleriesList = new DOMDeviantGalleryList($deviantid);
        $galleriesList    = new DeviantGalleriesList($DOMGalleriesList);

        $DOMGallery       = new DOMDeviantGallery($deviantid);
        $oneGallery       = new DeviantGallery($DOMGallery);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
  </head>
  <body>
      <h1>Deviant parser</h1>
      <p>
          API de récupération d'images de deviantart.
      </p>
      <h2>Version deviant art</h2>
      <p>
        <?php echo $version->deviantVersion; ?>
      </p>
      <h2>DeviantProfil</h2>
      <img src="<?php echo $profil->avatarSrc; ?>">
      <code>
          <pre>
            <?php var_dump($profil); ?>
          </pre>
      </code>
      <h2>Stats</h2>
      <ul>
          <li><?php echo $stats->deviations ; ?> <em>Deviations</em></li>
          <li><?php echo $stats->comments ; ?> <em>Comments</em></li>
          <li><?php echo $stats->pageviews ; ?> <em>Pageviews</em></li>
          <li><?php echo $stats->scraps ; ?> <em>Scraps</em></li>
          <li><?php echo $stats->watchers ; ?> <em>Watchers</em></li>
          <li><?php echo $stats->critiques ; ?> <em>Critiques</em></li>
          <li><?php echo $stats->forum_posts ; ?> <em>Forum_posts</em></li>
          <li><?php echo $stats->favourites ; ?> <em>Favourites</em></li>
      </ul>
      <h2>Featured</h2>
      <p>
          <?php echo $featured->featuredNodeList->length; ?> featured
      </p>
      <code>
          <pre>
            <?php var_dump($featured); ?>
          </pre>
      </code>
      <h2>Newest</h2>
      <p>
          <?php echo $newest->newestNodeList->length; ?> Newest
      </p>
      <code>
          <pre>
            <?php var_dump($newest); ?>
          </pre>
      </code>
      <h2>Favorites</h2>
      <p>
          <?php echo $favorites->favoritesNodeList->length; ?> Favorites
      </p>
      <code>
          <pre>
            <?php var_dump($favorites); ?>
          </pre>
      </code>
      <h2>Galleries list</h2>
      <p>
          <?php echo $galleriesList->galleriesNodeList->length; ?> Galleries
      </p>
      <code>
          <pre>
            <?php var_dump($galleriesList); ?>
          </pre>
      </code>
      <h2>One gallerie</h2>
      <p>
          <?php echo $oneGallery->pages; ?> pages
      </p>
      <code>
          <pre>
            <?php var_dump($oneGallery); ?>
          </pre>
      </code>
      <h2>Affichage d'une gallerie</h2>
      <?php
        $gallerie = new DisplayGallery( $oneGallery->deviationsSplObjectStorage );
        $gallerie->gallerie();
      ?>
  </body>
</html>
