<?php
/**
 * Polyline Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Layers
 */

namespace beastbytes\leaflet\layers\vector;

use yii\base\InvalidConfigException;
use yii\helpers\Json;
use beastbytes\leaflet\layers\Layer;

/**
 * Represents a Polyline on the map.
 */
class Polyline extends Layer
{
    use \beastbytes\leaflet\types\LatLngsTrait;

    /**
     * @property array events Events for the Polyline
     * @property JsExpression jsVar JavaScript variable name for the Polyline
     * control. If set the Polyline is assigned to this variable
     * @property LatLngs latLngs The geographical points of the Polyline
     * @property array options Options for the Polyline
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

        return $this->toJsExpression("{$map->leafletVar}.polyline
        ($latLngs, {$map->options2Js($this->options)})".$map->events2Js($this->events));
    }
}
