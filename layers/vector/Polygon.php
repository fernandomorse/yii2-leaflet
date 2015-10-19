<?php
/**
 * Polygon Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Layers
 */

namespace beastbytes\leaflet\layers\vector;

use yii\helpers\Json;

/**
 * Represents a Polygon on the map.
 */
class Polygon extends Polyline
{
    use \beastbytes\leaflet\types\LatLngsTrait;

    /**
     * @property array events Events for the Polygon
     * @property JsExpression jsVar JavaScript variable name for the Polygon
     * control. If set the Polygon is assigned to this variable
     * @property LatLngs latLngs The geographical points of the Polygon
     * @property array options Options for the Polygon
     */

    /**
     * Generates the object's JavaScript code
     *
     * @param Map $map The map widget
     * @return JsExpression Object JavaScript code
     */
    public function toJs($map)
    {
        $latLngs = Json::encode($this->getLatLngs());

        return $this->toJsExpression("{$map->leafletVar}.polygon
        ($latLngs, {$map->options2Js($this->options)})".$map->events2Js($this->events));
    }
}
