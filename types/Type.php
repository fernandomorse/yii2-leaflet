<?php
/**
 * Type Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Types
 */

namespace beastbytes\leaflet\types;

use yii\helpers\Inflector;
use yii\web\JsExpression;
use beastbytes\leaflet\Base;

/**
 * Base class for Leaflet types.
 */
abstract class Type extends Base
{
    private static $_counter = 0;

    /**
     * Creates a JavaScript variable name for the object
     *
     * @param string Prefix for JavaScript variable name
     * @return string JavaScript variable name for the object
     */
    public function jsVar($prefix = '')
    {
        return Inflector::variablize($prefix.' '.basename(get_class()).self::$_counter++);
    }

    /**
     * Finalises the JavaScript code and creates a JsExpression object.
     * Assigns the object to a variable if required
     *
     * @param string $js Object initialisation JavaScript
     * @return JsExpression Object JavaScript code
     */
    protected function toJsExpression($js)
    {
        if (isset($this->jsVar)) {
            $js = "var {$this->jsVar} = $js;";
        }

        return new JsExpression($js);
    }
}
