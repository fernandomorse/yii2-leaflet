<?php
/**
 * TileLayer Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Layers
 */

namespace beastbytes\leaflet\layers\raster;

use yii\base\InvalidConfigException;
use beastbytes\leaflet\layers\Layer;

/**
 * Represents a tile layer used to load and display a tile layer on the map.
 *
 * Use this class for providers not implemented by the TileProvider class
 */
class TileLayer extends Layer
{
    /**
     * @property array events Events for the TileLayer
     * @property JsExpression jsVar JavaScript variable name for the TileLayer
     * control. If set the TileLayer is assigned to this variable
     * @property array options Options for the TileLayer
     */

    /**
     * @param string the TileLayer URL template
     */
    private $_url;

    /**
     * Initialises the object
     *
     * @throws \yii\base\InvalidConfigException If the `url` attribute is not set
     */
    public function init()
    {
        parent::init();

        if (empty($this->_url)) {
            throw new InvalidConfigException('The `url` attribute must be set.');
        }
    }

    /**
     * @return string The URL template of the TileLayer
     */
    public function geturl()
    {
        return $this->_url;
    }

    /**
     * Sets the TileLayer's URL template.
     *
     * @param string $value The TileLayer's URL template
     */
    public function seturl($value)
    {
        $this->_url = $value;
    }

    /**
     * Generates the object's JavaScript code
     *
     * @param Map $map The map widget
     * @return JsExpression Object JavaScript code
     */
    public function toJs($map)
    {
        return $this->toJsExpression("{$map->leafletVar}.tileLayer('{$this->_url}', {$map->options2Js($this->options)})".$map->events2Js($this->events));
    }
}
