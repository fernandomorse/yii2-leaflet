<?php
/**
 * LayerGroup Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Layers
 */

namespace beastbytes\leaflet\layers\other;

use yii\base\InvalidParamException;
use yii\helpers\Json;
use beastbytes\leaflet\layers\Layer;

/**
 * Represents a layer group.
 * LayerGroup is used to group several layers and handle them as one. If a
 * LayerGroup is added to the map, any layers added to or removed from the group
 * using JavaScriptwill be added/removed on the map as well.
 */
class LayerGroup extends Layer
{
    /**
     * @var Layer[] Layers in the layer group
     */
    private $_layers = [];

    /**
     * Adds a layer
     *
     * @param Layer $layer The layer to be added
     * @throws InvalidParamException If $layer is not a Layer or is a TileLayer
     */
    public function addLayer($layer)
    {
        if (!($layer instanceof Layer)) {
            throw new InvalidParamException(strtr('Invalid Layer type &ndash; `{type}`: Overlays must be a child class of `Layer`.', [
                '{type}' => get_class($layer)
            ]));
        }

        $this->_layers[] = $layer;
    }

    /**
     * @return array The base layers
     */
    public function getLayers()
    {
        return $this->_layers;
    }

    /**
     * Remove a layer
     *
     * @param string $layer The layer to remove
     * @return boolean TRUE if the layer was removed from the group, FALSE if
     * the layer was not in the group
     */
    public function removeLayer($layer)
    {
        $index = array_search($layer, $this->_layers);
        if ($index !== false) {
            unset($this->_layers[$index]);
        }

        return is_integer($index);
    }

    /**
     * Sets the layers
     *
     * @param Layers[] $layers The layers
     */
    public function setLayers($layers)
    {
        foreach ($layers as $layer) {
            $this->addLayer($layer);
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
        $layers = [];
        foreach ($this->_layers as $layer) {
            $layers[] = $layer->toJs($map);
        }

        $layers = Json::encode($layers);
        return $this->toJsExpression("{$map->leafletVar}.layerGroup($layers)".$map->events2Js($this->events));
    }
}
