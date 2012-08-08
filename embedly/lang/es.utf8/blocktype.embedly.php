<?php
/**
 * Mahara: Electronic portfolio, weblog, resume builder and social networking
 * Copyright (C) 2006-2009 Catalyst IT Ltd and others; see:
 *                         http://wiki.mahara.org/Contributors
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    mahara
 * @subpackage blocktype-embedly
 * @author     Gregor Anzelj
 * @translator Iñaki Arenaza
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 2011 Gregor Anzelj, gregor.anzelj@gmail.com
 * @copyright  (C) 2011 Iñaki Arenaza, inaki.arenaza@gmail.com
 *
 * @translator Iñaki Arenaza
 */

defined('INTERNAL') || die();

$string['title'] = 'Embed.ly';
$string['description'] = 'Insertar contenido externo';
$string['mediaurl'] = 'URL del contenido';
$string['mediaurldescription2'] = 'Pegue la URL de la página donde está disponible el contenido (vídeo, imagen, audio, etc.). Puede incorporar contenido desde los siguientes %sservicios%s.';
$string['mediaurlpatterns'] = 'Para ver que patrones de URL puede incorporar desde cada servicio, abra la página de los %sservicios%s disponibles y pulse sobre el nombre del servicio.';
$string['showdescription'] = '¿Mostrar descripción del contenido?';
$string['width'] = 'Anchura';
$string['height'] = 'Altura';
$string['align'] = 'Alinear';
$string['alignleft'] = 'Izquierda';
$string['aligncenter'] = 'Centro';
$string['alignright'] = 'Derecha';
$string['invalidurl'] = 'URL inválida';

$string['apikey'] = 'Embed.ly clave de la API';
$string['apikeydescription'] = 'Para incrustar contenido de la web, usted necesitará una válida Embed.ly clave de la API. %sSolicitar su clave en línea gratis%s.';

$string['mediadesc'] = 'Descripción';
$string['mediadesc2'] = '¿Por qué eligió para integrar el contenido?';

$string['userapikey'] = 'Borrar la clave de API de Embed.ly';
$string['userapikeydescription'] = 'Si no se ha establecido una clave de API de Embed.ly para todo el sitio, cada usuario puede establecer su propia clave de API de Embed.ly. Si el usuario configura por accidente algo que no sea una clave de API de Embed.ly válida, el administrador puede borrar esa configuración';
$string['userid'] = 'ID de usuario';
$string['useriddesc'] = 'Introduzca el ID el usuario cuya clave de API de Embed.ly desee borrar. Después pulse el botón Guardar';

?>
