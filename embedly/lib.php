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
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 2011 Gregor Anzelj, gregor.anzelj@gmail.com
 *
 */

defined('INTERNAL') || die();

class PluginBlocktypeEmbedly extends SystemBlocktype {

    public static function get_title() {
        return get_string('title', 'blocktype.embedly');
    }

    public static function get_description() {
        return get_string('description', 'blocktype.embedly');
    }

    public static function get_categories() {
        return array(
			'external', // For Mahara 1.4.x and newer
			'feeds',    // For Mahara 1.3.x and older
		);
    }

    public static function render_instance(BlockInstance $instance, $editing=false) {
		global $USER;
		$embedlyapikey = $USER->get_account_preference('embedlyapikey');
        $configdata = $instance->get('configdata');
        $width   = (!empty($configdata['width'])) ? hsc($configdata['width']) : null;
        $height  = (!empty($configdata['height'])) ? hsc($configdata['height']) : null;
        $align  = (!empty($configdata['align'])) ? hsc($configdata['align']) : 'left';
		
        $result  = ''; // To silence warning
		
        if (isset($configdata['mediaid'])) {
            // IE seems to wait for all elements on the page to load
            // fully before the onload event goes off.  This means the
            // view editor isn't initialised until all videos have
            // finished loading, and an invalid video URL can stop the
            // editor from loading and result in an uneditable view.

            // Therefore, when this block appears on first load of the
            // view editing page, keep the embed code out of the page
            // initially and add it in after the page has loaded.

			$url = 'http://api.embed.ly/1/oembed?key=' . $embedlyapikey . '&url=' . urlencode($configdata['mediaid']) . '&maxwidth=' . $width . '&maxheight=' . $height . '&wmode=transparent';
            $request = array(
                CURLOPT_URL => $url,
            );
            $result = mahara_http_request($request);
            $data = json_decode($result->data, true);

			$result = '<div class="' . $align . '">';
			$result .= '<p>' . $configdata['mediadesc'] . '</p>';
			switch ($data['type']) {
				case 'photo':
					$result .= '<img src="' . $data['url'] . '" width="' . $width . '" height="' . $height . '" border="0">';
					break;
				case 'video':
				case 'rich' :
					$result .= $data['html'];
					break;
				case 'link' :
					$result .= $configdata['mediaid'];
					break;
			}

			if (isset($data['description']) && !empty($configdata['showdescription'])) {
				$result .= '<p>' . nl2br($data['description']) . '</p>';
			}
			$result .= '</div>';
        }

        return $result;
    }

    public static function has_instance_config() {
        return true;
    }

    public static function instance_config_form($instance) {
		global $USER;
		$embedlysiteapikey = get_config_plugin('blocktype', 'embedly', 'embedlysiteapikey');
		if (empty($embedlysiteapikey)) {
			$defaulttype = 'text';
			$embedlyapikey = $USER->get_account_preference('embedlyapikey');
			$defaultkey = (isset($embedlyapikey) ? $embedlyapikey : null);
		} else {
			$defaulttype = 'hidden';
			$defaultkey = $embedlysiteapikey;
		}
        $configdata = $instance->get('configdata');
        return array(
            'mediadesc' => array(
                'type'  => 'wysiwyg',
                'title' => get_string('mediadesc','blocktype.embedly'),
				'cols' => 80,
				'rows' => 6,
                'description' => get_string('mediadesc2','blocktype.embedly'),
                'defaultvalue' => isset($configdata['mediadesc']) ? $configdata['mediadesc'] : null,
            ),
            'mediaid' => array(
                'type'  => 'text',
                'title' => get_string('mediaurl','blocktype.embedly'),
                'description' => get_string('mediaurldescription2','blocktype.embedly', '<a href="http://embed.ly/providers" target="_blank">', '</a>')
								 . '<br>' . get_string('mediaurlpatterns','blocktype.embedly', '<a href="http://embed.ly/providers" target="_blank">', '</a>'),
                'defaultvalue' => isset($configdata['mediaid']) ? $configdata['mediaid'] : null,
                'rules' => array(
                    'required' => true
                ),
            ),
            'apikey' => array(
                'type'  => $defaulttype,
                'title' => get_string('apikey','blocktype.embedly'),
                'description' => get_string('apikeydescription','blocktype.embedly', '<a href="http://embed.ly/pricing/free" target="_blank">', '</a>'),
                'defaultvalue' => $defaultkey,
                'value' => $defaultkey,
                'rules' => array(
                    'required' => true
                ),
            ),
            'showdescription' => array(
                'type'  => 'checkbox',
                'title' => get_string('showdescription', 'blocktype.embedly'),
                'defaultvalue' => !empty($configdata['showdescription']) ? true : false,
            ),
            'width' => array(
                'type' => 'text',
                'title' => get_string('width','blocktype.embedly'),
                'size' => 3,
                'rules' => array(
                    'minvalue' => 100,
                    'maxvalue' => 800,
                ),
                'defaultvalue' => (!empty($configdata['width'])) ? $configdata['width'] : null,
            ),
            'height' => array(
                'type' => 'text',
                'title' => get_string('height','blocktype.embedly'),
                'size' => 3,
                'rules' => array(
                    'minvalue' => 100,
                    'maxvalue' => 800,
                ),
                'defaultvalue' => (!empty($configdata['height'])) ? $configdata['height'] : null,
            ),
            'align' => array(
                'type' => 'radio',
                'title' => get_string('align','blocktype.embedly'),
                'defaultvalue' => (!empty($configdata['align'])) ? $configdata['align'] : 'left',
				'options' => array(
					'left' => get_string('alignleft','blocktype.embedly'),
					'center' => get_string('aligncenter','blocktype.embedly'),
					'right' => get_string('alignright','blocktype.embedly'),
				),
				'separator' => '&nbsp;&nbsp;&nbsp;',
			),
        );
    }

    public static function instance_config_validate(Pieform $form, $values) {
        if ($values['mediaid']) {
            $urlparts = parse_url($values['mediaid']);
            if (empty($urlparts['host'])) {
                $form->set_error('mediaid', get_string('invalidurl', 'blocktype.embedly'));
            }
        }
    }

    public static function instance_config_save($values) {
		global $USER;
        if (isset($values['apikey'])) {
			$USER->set_account_preference('embedlyapikey', $values['apikey']);
			unset($values['apikey']);
		}
        if (isset($values['mediaid'])) {
			$values['mediaid'] = str_replace('https', 'http', $values['mediaid']);
		}
        return $values;
    }

    public static function has_config() {
        return true;
    }

    public static function get_config_options() {
        $elements = array();
        $elements['apikey'] = array(
            'type' => 'fieldset',
            'legend' => get_string('apikey', 'blocktype.embedly'),
            'elements' => array(
                'embedlysiteapikeydesc' => array(
					'type'  => 'html',
                    'value' => get_string('apikeydescription','blocktype.embedly', '<a href="http://embed.ly/pricing/free" target="_blank">', '</a>')
                ),
                'embedlysiteapikey' => array(
                    'title'        => get_string('apikey', 'blocktype.embedly'),
                    'type'         => 'text',
                    'defaultvalue' => get_config_plugin('blocktype', 'embedly', 'embedlysiteapikey'),
                )
            ),
        );
        $elements['userapikey'] = array(
            'type' => 'fieldset',
			'collapsible' => true,
			'collapsed' => true,
            'legend' => get_string('userapikey', 'blocktype.embedly'),
            'elements' => array(
                'embedlyuserapikeydesc' => array(
					'type'  => 'html',
                    'value' => get_string('userapikeydescription','blocktype.embedly', '<a href="http://embed.ly/pricing/free" target="_blank">', '</a>')
                ),
                'userid' => array(
                    'title'        => get_string('userid', 'blocktype.embedly'),
                    'type'         => 'text',
					'description'  => get_string('useriddesc', 'blocktype.embedly'),
                    'defaultvalue' => 0,
					'rules' => array('integer' => true),
                ),
				
            ),
        );
        return array(
            'elements' => $elements,
        );

    }

    public static function save_config_options($values) {
		// Set Embedly API key - this is site API key!
        set_config_plugin('blocktype', 'embedly', 'embedlysiteapikey', $values['embedlysiteapikey']);
		// If user ID is set, than clear Embedly API key for that user...
		if ($values['userid'] > 0) {
			set_field('usr_account_preference', 'value', null, 'usr', $values['userid'], 'field', 'embedlyapikey');
		}
    }

	
    public static function default_copy_type() {
        return 'full';
    }

}

?>
