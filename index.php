<?php
    $projectName             = 'My.DeviantArt API';
    $projectVersion          = '02-01-2012';
    $projectKeywords         = 'php, deviantart, api, PHP5';
    $projectShortDescription = 'API PHP5 de récupération d\'images de deviantart.';
?>
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
        // First we always need a DOMDocument to parse
        $DOMProfil    = new DOMDeviantProfil( $deviantid );

        // After we need to Xpath it to collect informations or deviations.
        // Here we want all profil informations
        $version      = new DeviantVersion( $DOMProfil );
        $profil       = new DeviantProfil( $DOMProfil );
        $stats        = new DeviantStats( $DOMProfil );
        $featured     = new DeviantFeatured( $DOMProfil );
        $newest       = new DeviantNewest( $DOMProfil );
        $favorites    = new DeviantFavorites( $DOMProfil );

        // Which are available galleries from a deviant user ?
        // First we need a DOMDocument to parse
        $DOMGalleriesList = new DOMDeviantGalleriesList( $deviantid );
        // As usual we Xpath it
        $galleriesList    = new DeviantGalleriesList( $DOMGalleriesList );
        
        $DOMGallery       = new DOMDeviantGallery( $deviantid );
        $oneGallery       = new DeviantGallery($DOMGallery);
        //var_dump( $oneGallery->pages );
        //var_dump( $oneGallery->pagesUrlList );

    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="<?php echo $projectKeywords; ?>" />
    <meta name="author" lang="fr" content="Inwebo" />
    <meta name="copyright" content="Creative commons" />
    <meta name="date" content="2012" />
    <title><?php echo $projectName; ?></title>
    <meta name="description" content="<?php echo $projectShortDescription; ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <a name="top"></a>
    <h1><?php echo $projectName; ?> <span id="version">version : <span><?php echo $projectVersion; ?></span></span></h1>
    <p>
        API de récupération d'images de deviantart voir <a href="README" target="_blank">readme</a>. Compatible
        <?php echo $version->deviantVersion; ?>
    </p>
</header>
<div role="main">
    <h2>Source <a href="#top">TOP</a></h2>
      <form name="deviantIdForm" method="post">
          <label>Deviant id : <input type="text" value="" name="deviantId"> (mine is inwebo)</label>
          <input type="submit">
      </form>
    <hr>
    <h3><img src="<?php echo $profil->avatarSrc; ?>"><?php echo $profil->prefix ?><?php echo $profil->deviantId ?> 's DeviantProfil from <?php echo $profil->country; ?> <a href="#top">TOP</a></h3>
      <h2>Stats <a href="#top">TOP</a></h2>
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
    <hr>
    <h2>Featured (<?php echo $featured->nodeList->length; ?>) <a href="#top">TOP</a></h2>
    <p>
      <?php
        $gallerie = new DisplayGallery( $featured->splObjectStorage );
        $gallerie->gallerie();
      ?>
    </p>
    <hr>
      <h2>Newest (<?php echo $newest->nodeList->length; ?>) <a href="#top">TOP</a></h2>
      <p>
      <?php
        $gallerie = new DisplayGallery( $newest->splObjectStorage );
        $gallerie->gallerie();
      ?>
      </p>
          <hr>
      <h2>Favorites (<?php echo $favorites->nodeList->length; ?>) <a href="#top">TOP</a></h2>
      <p>
      <?php
        $gallerie = new DisplayGallery( $favorites->splObjectStorage );
        $gallerie->gallerie();
      ?>
      </p>
          <hr>
      <h2>Galleries list (<?php echo $galleriesList->nodeList->length; ?>) <a href="#top">TOP</a></h2>
      <ul>
      <?php
        $gallerieList = new DisplayGalleriesList( $galleriesList->splObjectStorage );
        $gallerieList->galleriesList();
      ?>
      </ul>
          <hr>
      <h3>Galleries list as array <a href="#top">TOP</a></h3>
      <code>
          <pre>
          <?php
            var_dump( $galleriesList->toArray($galleriesList->splObjectStorage) );
          ?>
          </pre>
      </code>
      <h2>Gallerie</h2>
      <?php
        $gallerie       = new Gallery('inwebo', 'http://inwebo.deviantart.com/gallery/12613778');
        $displayGallery = new DisplayGallery( $gallerie->page(0) );
        $displayGallery->gallerie();
      ?>
      <hr>
      <h2>Custom display</h2>
      <?php
        class CustomDisplay extends Display {
            
            public function  __construct( SplObjectStorage $collection ) {
                parent::__construct($collection);
            }

            public function CustomGallery() {
                Display::fetchObject( 'CustomDisplay::CustomDeviation' );
            }

            public function CustomDeviation( $object ) {
                echo '<figure>
                            <a href="' . $object->deviantUrl . '" target="_blank" title="'. $object->title .'">
                                <img src="' . $object->deviationMediumSrc . '" alt="' .$object->title . '" width="'.$object->deviationMediumWidth.'" height="'.$object->deviationMediumHeight.'">
                            </a>
                            <figcaption>' . $object->title . '</figcaption>
                      </figure>';
            }

      }

        $CustomGallerie = new Gallery('inwebo');
        $displayGallery = new CustomDisplay( $CustomGallerie->page(0) );
        $displayGallery->CustomGallery();
        
      ?>
      <hr>
      <h2>Creation archive PHAR <a href="#top">TOP</a></h2>
      <p>
          <a href="make.php" target="_blank">make</a>
      </p>


</div>
<footer>
    <p>
        <a title="Julien Hannotin" href="http://julien.hannotin.is.free.fr" target="_blank" title="Résumé">Jool</a> | <a href="http://creativecommons.org/licenses/by-nc-sa/2.0/fr/" title="Creative Commons 2"  target="_blank">creative commons 2</a> | <a title="Git repository" target="_blank" href="https://github.com/inwebo/">Github Repository</a> | <a href="#top">top</a>
    </p>
</footer>
</body>
</html>