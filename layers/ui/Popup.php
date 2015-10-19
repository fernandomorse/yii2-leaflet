<?php
/**
 * Popup Class file
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
 * Represents a Popup on the map.
 */
class Popup extends Layer
{
    use \beastbytes\leaflet\types\LatLngTrait;

    /**
     * @property array events Events for the Popup
     * @property JsExpression jsVar JavaScript variable name for the Popup
     * control. If set the Popup is assigned to this variable
     * @property LatLng latLng The geographical centre of the Popup
     * @property array options Options for the Popup
     */

    /**
     * @param string the Popup content
     */
    private $_content;

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
     * @return string The Popup content
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * @param string $value The Popup content
     */
    public function setContent($value)
    {
        $this->_content = $value;
    }

    /**
     * Generates the object's JavaScript code
     *
     * @param Map $map The map widget
     * @return JsExpression Object JavaScript code
     */
    public function toJs($map)
    {
        return $this->toJsExpression("{$map->leafletVar}.popup({$map->options2Js($this->options)}).setContent('{$this->_content}').setLatLng({$this->getLatLng()->toJs($map)})".$map->events2Js($this->events));
    }
}
