<?php
/**
 * My.Deviant API
 *
 * LICENCE
 *
 * Vous êtes libre de :
 *
 * Partager : reproduire, distribuer et communiquer l'oeuvre
 * Remixer  : adapter l'oeuvre
 *
 * Selon les conditions suivantes :
 *
 * Attribution : Vous devez attribuer l'oeuvre de la manière indiquée par
 * l'auteur de l'oeuvre ou le titulaire des droits (mais pas d'une manière
 * qui suggérerait qu'ils vous soutiennent ou approuvent votre utilisation
 * de l'oeuvre).
 *
 * Pas d’Utilisation Commerciale : Vous n'avez pas le droit d'utiliser cette
 * oeuvre à des fins commerciales.
 *
 * Partage à l'Identique : Si vous modifiez, transformez ou adaptez cette
 * oeuvre, vous n'avez le droit de distribuer votre création que sous une
 * licence identique ou similaire à celle-ci.
 *
 * Remarque : A chaque réutilisation ou distribution de cette oeuvre, vous
 * devez faire apparaître clairement au public la licence selon laquelle elle
 * est mise à disposition. La meilleure manière de l'indiquer est un lien vers
 * cette page web.
 *
 */

/**
 * Custom Display example
 *
 * @category  My.Deviant API
 * @package   Example
 * @copyright Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
 * @author    Julien Hannotin
 * @license   http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version   $Id:$
 * @link      https://github.com/inwebo/My.DeviantArtParser
 * @since     File available since Beta 01-02-2012
 */

// First we must extends Display class
class CustomDisplay extends Display {

    // As usual call construct parent
    public function __construct( SplObjectStorage $collection ) {
        parent::__construct($collection);
    }

    // There is our public method
    public function CustomGallery() {
        // fetchObject need a callback method, which will be called on every
        // iteration. Callback method is an HTML representation of Deviation object
        Display::fetchObject('CustomDisplay::CustomDeviation');
    }

    // And this is where we can customize our display
    // This is an HTML5 exemple
    protected function CustomDeviation($object) {

        // Save locally in temp/ dir
        $object->save('temp/');

        echo '<figure>
                <a href="' . $object->deviantUrl . '" target="_blank" title="' . $object->title . '">
                    <img src="' . $object->deviationSmallSrc . '" alt="' . $object->title . '" width="' . $object->deviationSmallWidth . '" height="' . $object->deviationSmallHeight . '">
                </a>
                <figcaption>' . $object->title . '</figcaption>
              </figure>';
    }

}