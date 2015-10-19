<?php
/**
 * ImageOverlay Class file
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
 * Represents a ImageOverlay on the map.
 * Used to load and display a single image over specific bounds of the map.
 */
class ImageOverlay extends Layer
{
    use \beastbytes\leaflet\types\LatLngBoundsTrait;

    /**
     * @property array events Events for the ImageOverlay
     * @property JsExpression jsVar JavaScript variable name for the ImageOverlay
     * control. If set the ImageOverlay is assigned to this variable
     * @property LatLngBounds bounds The geographical bounds of the ImageOverlay
     * @property array options Options for the ImageOverlay
     */

    /**
     * @param string the image url
     */
    private $_url;

    /**
     * Initialises the object
     *
     * @throws \yii\base\InvalidConfigException If the `position` attribute is not set
     */
    public function init()
    {
        parent::init();

        if (empty($this->getBounds()) || empty($this->_url)) {
            throw new InvalidConfigException('The `bounds` and `url` attributes must be set.');
        }
    }

    /**
     * @return string The image url
     */
    public function getUrl()
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
        return $this->toJsExpression("{$map->leafletVar}.imageOverlay({$this->_url}, {$this->getBounds()->toJs($map)}, {$this->options->toJs()})".$map->events2Js($this->events));
    }
}
