<?php
/**
 *
 * @package    mahara
 * @subpackage blocktype-embedly
 * @author     Gregor Anzelj
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 2011 Gregor Anzelj, gregor.anzelj@gmail.com
 *
 * @translator Dominique-Alain Jan
 * @translator Stéphane Lavoie
 *
 */

defined('INTERNAL') || die();

$string['title'] = 'Embed.ly';
$string['description'] = 'Incorporer une ressource externe';
$string['mediaurl'] = 'Adresse URL de la ressource';
$string['mediaurldescription2'] = 'Coller l\'adresse URL de la page où se trouve la ressource (vidéo, image, audio, etc.). Vous pouvez incorporer des ressources de ces %sservices%s.';
$string['mediaurlpatterns'] = 'Pour vérifier le modèle d\'adresse URL de chaque service que vous pouvez incorporer, consultez la page des %sservices%s offerts et cliquez sur le nom du service.';
$string['showdescription'] = 'Afficher la description de la ressource?';
$string['width'] = 'Largeur';
$string['height'] = 'Hauteur';
$string['align'] = 'Alignement';
$string['alignleft'] = 'Gauche';
$string['aligncenter'] = 'Centre';
$string['alignright'] = 'Droit';
$string['invalidurl'] = 'Adresse URL invalide';

$string['apikey'] = 'Clef de l\'API de Embed.ly';
$string['apikeydescription'] = 'Pour incorporer des ressources web, vous aurez besoin d\'une clé valide de l\'API de Embed.ly. %sDemandez votre clé gratuite en ligne%s.';

$string['mediadesc'] = 'Description';
$string['mediadesc2'] = 'Pourquoi avez-vous choisi d\'incorporer cette ressource?';

$string['userapikey'] = 'Effacer la clé API Embed.ly de l\'utilisateur';
$string['userapikeydescription'] = 'Si la clé API Embded.ly n\'est pas définie au niveau du site, chaque utilisateur peut alors utiliser sa propre clé API Embed.ly. Si un utilisateur saisit une information erronée dans cette rubrique, un administrateur du site peut supprimer cette information.';
$string['userid'] = 'Nom d\'utilisateur';
$string['useriddesc'] = 'Entrez le nom d\'utilisateur de l\'utilisateur pour lequel vous désirez supprimer la clé API Embed.ly API. Cliquez ensuite sur le bouton Enregistrer.';

?>
