<?php
/**
 * Marker Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Layers
 */

namespace beastbytes\leaflet\layers\ui;

use yii\base\InvalidConfigException;
use beastbytes\leaflet\layers\Layer;

/**
 * Represents a marker on the map.
 */
class Marker extends Layer
{
    use \beastbytes\leaflet\types\LatLngTrait, \beastbytes\leaflet\layers\ui\PopupTrait;

    /**
     * @property array events Events for the Marker
     * @property JsExpression jsVar JavaScript variable name for the Marker
     * control. If set the Marker is assigned to this variable
     * @property LatLng latLng The geographical centre of the Marker
     * @property array options Options for the Marker
     */

    /**
     * Initialises the object
     *
     * @throws \yii\base\InvalidConfigException If the `position` attribute is not set
     */
    public function init()
    {
        parent::init();

        if (empty($this->getLatLng())) {
            throw new InvalidConfigException('The `latLng` attribute must be set.');
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
        return $this->toJsExpression("{$map->leafletVar}.marker({$this->getLatLng()->toJs($map)}, {$map->options2Js($this->options)})".$map->events2Js($this->events).$this->popup());
    }
}
