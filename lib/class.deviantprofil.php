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
 * Query a DOMDocument searching for user profil.
 *
 * @category  My.Deviant API
 * @package   Base
 * @copyright Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
 * @author    Julien Hannotin
 * @license   http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version   $Id:$
 * @link      https://github.com/inwebo/My.DeviantArtParser
 * @since     File available since Beta 01-02-2012
 *
 */
class DeviantProfil extends DeviantParser {

    /**
     * All nodes from about me page section
     * 
     * @var DOMNodeList
     */
    public $aboutMeNodeList;

    /**
     * All nodes from user badge page section
     *
     * @var DOMNodeList
     */
    public $userBadgeMeNodeList;

    /**
     * All nodes from avatar page section
     *
     * @var DOMNodeList
     */
    public $avatarNodeList;

    /**
     * Account type, member, premium etc
     *
     * @var string
     */
    public $type;

    /**
     * Username's prefix ie members have a ~
     *
     * @var string
     */
    public $prefix;

    /**
     * User's country
     *
     * @var string
     */
    public $country;

    /**
     * User's deviantId
     *
     * @var string
     */
    public $deviantId;

    /**
     * Next line from your Username
     *
     * @var string
     */
    public $tagLine;

    /**
     * Avatar source image
     *
     * @var string
     */
    public $avatarSrc;

    /**
     * Init profil from queries
     *
     * @param DOMDocument $doc
     * @return void
     */
    public function  __construct(DOMDocument $doc) {
        parent::__construct($doc);
        
        $this->aboutMeNodeList     = $this->query("//div[@id='super-secret-why']/div[@class='gr-body']/div[@class='gr']/div[@class='pbox']/dl[@class='f']/*");
        $this->type                = $this->setDefault( $this->aboutMeNodeList, 0 );
        $this->deviantId           = $this->setDefault( $this->aboutMeNodeList, 1 );
        $this->country             = $this->setDefault( $this->aboutMeNodeList, 2 );

        $this->userBadgeMeNodeList = $this->query("//div[@class='gruserbadge']");
        $buffer                    = $this->setDefault($this->userBadgeMeNodeList, 0);
        $buffer                    = explode(' ', $this->sTrim($buffer));
        $this->prefix              = $buffer[0][0];
        $this->tagLine             = $buffer[1];

        $this->avatarNodeList      = $this->query("//div[@class='catbar']/div/a/img");
        $this->avatarSrc           = $this->avatarNodeList->item(0)->attributes->getNamedItem("src")->nodeValue ;

    }

    /**
     * Clean up a string
     *
     * @param string $string
     * @return string
     * @see http://blog.studiovitamine.com/actualite,107,fr/php-supprimer-les-espaces-inutiles-d-une-chaine-de-caracteres,304,fr.html?id=141
     */
    public function sTrim( $string ) {
	$string = trim($string);
	$string = preg_replace("( +)", " ", $string);
	return $string;
    }

}