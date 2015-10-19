<?php
/**
 * Circle Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Layers
 */

namespace beastbytes\leaflet\layers\vector;

use yii\base\InvalidConfigException;

/**
 * Represents a Circle on the map.
 */
class Circle extends CircleMarker
{
    use \beastbytes\leaflet\types\LatLngTrait;

    /**
     * @property array events Events for the Circle
     * @property JsExpression jsVar JavaScript variable name for the Circle
     * control. If set the Circle is assigned to this variable
     * @property LatLng latLng The geographical centre of the Circle
     * @property array options Options for the Circle
     */

    /**
     * Generates the object's JavaScript code
     *
     * @param Map $map The map widget
     * @return JsExpression Object JavaScript code
     */
    public function toJs($map)
    {
        return $this->toJsExpression("{$map->leafletVar}.circle({$this->getLatLng()->toJs($map)}, {$map->options2Js($this->options)})".$map->events2Js($this->events));
    }
}
