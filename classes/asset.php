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
		require_once PKGPATH.'less'.DS.'vendor'.DS.'lessphp'.DS.'lessc.inc.php';
		
		if(!is_array($stylesheets))
		{
			$stylesheets = array($stylesheets);
		}
		
		foreach($stylesheets as &$lessfile)
		{
			$source_less	= APPPATH.\Config::get('less.path').$lessfile; // Name of source filename
			$compiled_css	= DOCROOT.\Arr::get(\Config::get('asset.paths'), 0).\Config::get('asset.css_dir').pathinfo($lessfile, PATHINFO_FILENAME).'.css'; // Name of destination CSS compiled file
			
			if(!is_file($source_less))
			{
				throw new \Fuel_Exception('Could not find lesscss source file: '.$source_less);
			}
			
			\lessc::ccompile($source_less, $compiled_css);
			
			// Change the name to load as CSS asset
			$lessfile = str_replace(pathinfo($lessfile, PATHINFO_EXTENSION), '', $lessfile).'css';
		}
		
		return static::css($stylesheets, $attr, $group, $raw);
	}
}
