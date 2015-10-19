<?php
/**
 * Layer Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Layers
 */

namespace beastbytes\leaflet\layers;

use yii\helpers\Inflector;
use yii\web\JsExpression;
use beastbytes\leaflet\Base;

/**
 * Base class for Leaflet Layers.
 */
abstract class Layer extends Base
{
    /**
     * @var integer a counter used to generate jsVar
     */
    private static $_counter = 0;

    /**
     * @var boolean Whether the component is draggable
     */
    public $draggable = false;

    /**
     * @var boolean|string Map name.
     * If a string the generated JavaScript will include the addTo(map) method,
     * if FALSE the addTo(map) method is not included - this allows layers to be
     * added to the Layers control to control visibility without initally being
     * added to the map
     */
    public $map;

    /**
     * Finalises the JavaScript code and creates a JsExpression object.
     * Assigns the object to a variable and/or adds the layer to the map if required
     *
     * @param string $js Object initialisation JavaScript
     * @return JsExpression Object JavaScript code
     */
    protected function toJsExpression($js)
    {
        if (isset($this->jsVar)) {
            $js = "var {$this->jsVar} = $js".(empty($this->map) ? ';' : '');
        }

        if (!empty($this->map)) {
            $js .= ".addTo({$this->map});";
        }

        return new JsExpression($js);
    }

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
}
