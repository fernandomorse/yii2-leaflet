<?php
/**
 * CircleMarker Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Layers
 */

namespace beastbytes\leaflet\layers\vector;

use yii\base\InvalidConfigException;

/**
 * Represents a CircleMarker on the map.
 */
class CircleMarker extends Path
{
    use \beastbytes\leaflet\types\LatLngTrait;

    /**
     * @property array events Events for the CircleMarker
     * @property JsExpression jsVar JavaScript variable name for the CircleMarker
     * control. If set the CircleMarker is assigned to this variable
     * @property LatLng latLng The geographical centre of the CircleMarker
     * @property array options Options for the CircleMarker
     */

    /**
     * Initialises the object
     *
     * @throws \yii\base\InvalidConfigException If the `latLng` attribute is not set
     */
    public function init()
    {
        parent::init();

        if (empty($this->getLatLng())) {
            throw new InvalidConfigException('The `latLng` attribute must be set.');
        }

        if (empty($this->options['radius'])) {
            throw new InvalidConfigException('The `radius` option must be set.');
        }
    }

    /**
     * Generates the object's JavaScript code
     *
     * @param Map $map The map widget
     * @return JsExpression Object JavaScript code
     */
    public function toJs($map)
    {
        return $this->toJsExpression("{$map->leafletVar}.circleMarker({$this->getLatLng()->toJs($map)}, {$map->options2Js($this->options)})".$map->events2Js($this->events));
    }
}
