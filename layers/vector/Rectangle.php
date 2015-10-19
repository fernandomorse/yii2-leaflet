<?php
/**
 * Rectangle Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Layers
 */

namespace beastbytes\leaflet\layers\vector;

use yii\base\InvalidConfigException;
use beastbytes\leaflet\layers\Layer;

/**
 * Represents a Rectsngle on the map.
 */
class Rectsngle extends Layer
{
    use \beastbytes\leaflet\types\LatLngBoundsTrait;

    /**
     * @property array events Events for the Rectangle
     * @property JsExpression jsVar JavaScript variable name for the Rectangle
     * control. If set the Rectangle is assigned to this variable
     * @property LatLngBounds bounds The geographical bounds of the Rectangle
     * @property array options Options for the Rectangle
     */

    /**
     * Initialises the object
     *
     * @throws \yii\base\InvalidConfigException If the `bounds` attribute is not set
     */
    public function init()
    {
        if (empty($this->getBounds())) {
            throw new InvalidConfigException('The `bounds` attribute must be set.');
        }

        parent::init();
    }

    /**
     * Generates the object's JavaScript code
     *
     * @param Map $map The map widget
     * @return JsExpression Object JavaScript code
     */
    public function toJs($map)
    {
        return $this->toJsExpression("{$map->leafletVar}.rectangle({$this->getBounds()->toJs($map)}, {$this->options->toJs()})".$map->events2Js($this->events));
    }
}
