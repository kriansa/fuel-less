<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Less;

class Asset extends \Fuel\Core\Asset {

	public static function _init()
	{
		parent::_init();
		
		\Config::load('less', true);
	}
	
	public static function less($stylesheets = array(), $attr = array(), $group = NULL, $raw = false)
	{
		if (!is_array($stylesheets)) {
			$stylesheets = array($stylesheets);
		}
		
		// Get all the asset CSS paths (for a better @include integration)
		$include_paths = \Config::get('asset.paths');

		foreach ($include_paths as &$path) {
			$path = DOCROOT . $path . \Config::get('asset.css_dir');
		}

		$include_paths[] = APPPATH . \Config::get('less.path');
		
		foreach ($stylesheets as &$lessfile) {
			$source_less = APPPATH . \Config::get('less.path') . $lessfile;
			$compiled_css = DOCROOT . \Arr::get(\Config::get('asset.paths'), \Config::get('less.default_path_key')) . \Config::get('asset.css_dir') . pathinfo($lessfile, PATHINFO_FILENAME) . '.css';
			
			if (!is_file($source_less)) {
				throw new \Fuel_Exception('Could not find lesscss source file: ' . $source_less);
			}
			
			// Compile only if source is newer than compiled file
			if (!is_file($compiled_css) || filemtime($source_less) > filemtime($compiled_css)) {
				require_once PKGPATH . 'less' . DS . 'vendor' . DS . 'lessphp' . DS . 'lessc.inc.php';
				
				$handle = new \lessc($source_less);
				$handle->importDir = $include_paths;
				$handle->indentChar = '	'; // Tab instead 2 spaces
				file_put_contents($compiled_css, $handle->parse());
			}
			
			// Change the name to load as CSS asset
			$lessfile = str_replace(pathinfo($lessfile, PATHINFO_EXTENSION), '', $lessfile) . 'css';
		}
		
		return static::css($stylesheets, $attr, $group, $raw);
	}
}