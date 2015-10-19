<?php
/**
 * Layers Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Controls
 */

namespace beastbytes\leaflet\controls;

use yii\base\InvalidParamException;
use yii\helpers\Json;
use beastbytes\leaflet\layers\Layer;
use beastbytes\leaflet\layers\raster\TileLayer;

/**
 * Represents a layers control
 */
class Layers extends Control
{
    /**
     * @property array events Events for the Layers control
     * @property JsExpression jsVar JavaScript variable name for the Layers
     * control. If set the Layers control is assigned to this variable
     * @property array options Options for the Layers control
     */

    /**
     * @var array Map base layers in the format "label" => layer
     * Only one base layer is visible at any time
     */
    private $_baseLayers = [];

    /**
     * @var array Map overlay layers in the format "label" => layer
     * Overlay layers can be individually shown or hidden
     */
    private $_overlays = [];

    /**
     * Adds a base layer
     *
     * @param string The layer label
     * @param Layer $layer The layer
     * @throws InvalidParamException If $layer is not a TileLayer
     */
    public function addBaseLayer($label, $layer)
    {
        if (!($layer instanceof TileLayer)) {
            throw new InvalidParamException(strtr('Invalid Base Layer type &ndash; `{type}`: Base Layers must be of type `TileLayer`.', [
                '{type}' => get_class($layer)
            ]));
        }

        $layer->jsVar; // reading jsVar ensures that it is set
        $this->_baseLayers[$label] = $layer;
    }

    /**
     * Adds an overlay layer
     *
     * @param string The layer label
     * @param Layer $layer The layer
     * @throws InvalidParamException If $layer is not a Layer or is a TileLayer
     */
    public function addOverlay($label, $layer)
    {
        if (!($layer instanceof Layer) || ($layer instanceof TileLayer)) {
            throw new InvalidParamException(strtr('Invalid Overlay type &ndash; `{type}`: Overlays must be a child class of `Layer`, but not a `TileLayer`.', [
                '{type}' => get_class($layer)
            ]));
        }

        $layer->jsVar; // reading jsVar ensures that it is set
        $this->_overlays[$label] = $layer;
    }

    /**
     * @return array The base layers
     */
    public function getBaseLayers()
    {
        return $this->_baseLayers;
    }

    /**
     * @return array The overlays
     */
    public function getOverlays()
    {
        return $this->_overlays;
    }

    /**
     * Remove a layer
     *
     * @param string $label The label of the layer to remove
     * @return Layer The layer removed or NULL if no layer removed
     */
    public function removeLayer($label)
    {
        $layer = null;

        if (isset($this->_baseLayers[$label])) {
            $layer = $this->_baseLayers[$label];
            unset($this->_baseLayers[$label]);
        } else if (isset($this->_overlays[$label])) {
            $layer = $this->_overlays[$label];
            unset($this->_overlays[$label]);
        }

        return $layer;
    }

    /**
     * Add base layers
     *
     * @param array $layers Base layers
     */
    public function setBaseLayers($layers)
    {
        foreach ($layers as $label => $layer) {
            $this->addBaseLayer($label, $layer);
        };
    }

    /**
     * Add overlays
     *
     * @param array $layers Overlays
     */
    public function setOverlays($layers)
    {
        foreach ($layers as $label => $layer) {
            $this->addOverlay($label, $layer);
        };
    }

    /**
     * Generates the object's JavaScript code
     *
     * @param Map $map The map widget
     * @return JsExpression Object JavaScript code
     */
    public function toJs($map)
    {
        $baseLayers = $overlays = [];

        foreach ($this->_baseLayers as $key => $layer) {
            $baseLayers[$key] = $layer->jsVar;
        }

        foreach ($this->_overlays as $key => $layer) {
            $overlays[$key] = $layer->jsVar;
        }

        $baseLayers = Json::encode($baseLayers);
        $overlays = Json::encode($overlays);

        return $this->toJsExpression("{$map->leafletVar}.control.layers($baseLayers, $overlays, {$map->options2Js($this->options)})");
    }
}
