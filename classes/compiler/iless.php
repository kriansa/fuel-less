<?php
/**
 * FuelPHP LessCSS package implementation.
 *
 * Adds support for Michal Moravec's iLess (https://github.com/mishal/iless)
 * 
 * Add to composer.json:
 *   "require": {
 *        "mishal/iless": "1.7.*@dev"
 *    },
 *
 * Enable PHP extensions:
 *  - bcmath.so
 *  - tokenizer.so
 *
 * @author     PWolfert
 * @version    1.0
 * @package    Fuel
 * @subpackage Less
 */
namespace Less;

class Compiler_Iless
{
	/**
	 * Store an instance of the ILess_Parser
	 * @var ILess_Parser
	 */
	protected static $_parser = null;

	/**
	 * Init the class
	 */
	public static function _init()
	{
		//static::$_parser = new ILess_Parser
	}

	/**
	 * Compile the Less file in $origin to the CSS $destination file
	 *
	 * @param string $origin Input Less path
	 * @param string $destination Output CSS path
	 */
	public static function compile($origin, $destination)
	{
		$parser = new \ILess_Parser();
		$parser->parseFile($origin);

		$destination = pathinfo($destination);
		\File::update($destination['dirname'], $destination['basename'], $parser->getCSS());
	}
}