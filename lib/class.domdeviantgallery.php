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
 * Utilisateur depuis 5 ans maintenant du site http://www.deviantart.com/ ( que
 * je vous conseil au passage ), je fais un constat trés amer : Mais bordel OU
 * se trouve votre API ? Vos flux rss et tout ce qui fait un site moderne ? Co-
 * -mment maintenir mon portfolio synchronisé avec mon compte deviantart sans y
 * passer 1H ? C'est vraiment trop ? FlickR dispose lui depuis quelques temps 
 * maintenant de son API, faut en prendre de la graine les copains.
 *
 * Alors voilà une class PHP5 utilisant l'extension DOM pour parser votre compte
 *  deviant art et renvoyer toutes les infos nécessaires (avatar, id, gallerie).
 * Rien de bien compliqué mais cela rends bien des services à tous nos amis pro-
 * crastinateurs.
 *
 * Fonctionnement trés simple, je considère qu'une page retourné par deviantart
 *  est un arbre DOM, qu'il suffira de parser avec des requêtes Xpath pour en
 * extraire les informations que l'on souhaite.
 *
 * ! Mise en garde !
 * J'ai lu la charte d'utilisation et cette class n'as pas l'air de rentrer en
 * conflit avec, donc si des anglophones (avertis) pouvaient me confirmer.
 *
 * Par contre vous DEVEZ utiliser cette class uniquement avec VOTRE COMPTE
 * deviantart, je n'ai pas écrit cette API dans l'idée de piller le travail des
 * autres. VOUS êtes responsable de ce que vous faites !
 *
 * Protips, mettez en CACHE tout ce que vous allez récupèrer, les
 * images et les pages HTML. Deviantart se réserve le droit de BANNIR des IP si
 * ils considèrent (à tort ou à raison) qu'il y a une utilisation frauduleuse du
 *  service.
 *
 * 
 * @category  My.Deviant API
 * @package   Base
 * @copyright Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
 * @author    Julien Hannotin
 * @license   http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version   $Id:$
 * @link      https://github.com/inwebo/My.MVC
 * @since     File available since Beta 28-11-2011
 *
 */

class DOMDeviantGallery extends DOMDeviant{

    public function __construct( $profilId ) {
        parent::__construct( $profilId );

        if( $this->getHTML( $this->galleryUrl ) ) {
            @$this->loadHTML( $this->html );            
        }

    }

}