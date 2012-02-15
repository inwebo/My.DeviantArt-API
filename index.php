<?php include 'autoload.php'; ?>
<?php ini_set('display_errors', TRUE ); ?>
<?php

    (!isset($_POST['deviantId'])) ? $_POST['deviantId']= 'inwebo' : NULL ;


    if( $_POST['deviantId'] !== NULL || $_POST['deviantId'] !== '' ) {
        $deviantid = $_POST['deviantId'];
    }
    else {
        $deviantid = 'inwebo';
        $galleryUrl = 'http://inwebo.deviantart.com/gallery/12613778';
    }

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
    <title>Deviant art API</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
  </head>
  <body>
      <h1>Deviant API</h1>
      <p>
          API de récupération d'images de deviantart voir <a href="README">readme</a>.
      </p>
      <h2>Version deviant art</h2>
      <p>
        Compatible <?php echo $version->deviantVersion; ?>
      </p>
      <form name="deviantIdForm" method="post">
          <label>Deviant id : <input type="text" value="" name="deviantId"> (mine is inwebo)</label>
          <input type="submit">
      </form>


      <h2><img src="<?php echo $profil->avatarSrc; ?>"><?php echo $profil->prefix ?><?php echo $profil->deviantId ?> 's DeviantProfil from <?php echo $profil->country; ?></h2>
      <h2>Stats</h2>
      <ul>
          <li><?php echo $stats->deviations ; ?> <em>Deviations</em></li>
          <li><?php echo $stats->comments ; ?> <em>Comments</em></li>
          <li><?php echo $stats->pageviews ; ?> <em>Pageviews</em></li>
          <li><?php echo $stats->scraps ; ?> <em>Scraps</em></li>
          <li><?php echo $stats->watchers ; ?> <em>Watchers</em></li>
          <li><?php echo $stats->critiques ; ?> <em>Critiques</em></li>
          <li><?php echo $stats->forumPosts ; ?> <em>Forum posts</em></li>
          <li><?php echo $stats->favourites ; ?> <em>Favourites</em></li>
      </ul>
      <h2>Featured (<?php echo $featured->featuredNodeList->length; ?>)</h2>
      <p>
      <?php
        $gallerie = new DisplayGallery( $featured->featuredDeviationsSplObjectStorage );
        $gallerie->gallerie();
      ?>
      </p>
      <h2>Newest (<?php echo $newest->newestNodeList->length; ?>)</h2>
      <p>
      <?php
        $gallerie = new DisplayGallery( $newest->newestDeviationsSplObjectStorage );
        $gallerie->gallerie();
      ?>
      </p>
      <h2>Favorites (<?php echo $favorites->favoritesNodeList->length; ?>)</h2>
      <p>
      <?php
        $gallerie = new DisplayGallery( $favorites->favoritesDeviationsSplObjectStorage );
        $gallerie->gallerie();
      ?>
      </p>
      <h2>Galleries list (<?php echo $galleriesList->galleriesNodeList->length; ?>)</h2>
      <ul>
      <?php
        $gallerieList = new DisplayGalleriesList( $galleriesList->galleriesSplObjectStorage );
        $gallerieList->galleriesList();
      ?>
      </ul>
      <h3>As array</h3>
      <pre>
      <code>
          <?php
            var_dump( $galleriesList->toArray($galleriesList->galleriesSplObjectStorage) );
          ?>
      </code>
      </pre>
      <h2>Une gallerie (<?php echo $oneGallery->pages; ?> pages)</h2>
      <?php
        $gallerie = new DisplayGallery( $oneGallery->deviationsSplObjectStorage );
        $gallerie->gallerie();
      ?>
      <h2>Creation archive PHAR</h2>
      <p>
          <a href="make.php">make</a>
      </p>
  </body>
</html>
