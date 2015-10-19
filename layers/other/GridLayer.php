<?php
/**
 * GridLayer Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Layers
 */

namespace beastbytes\leaflet\layers\other;

use beastbytes\leaflet\layers\Layer;

/**
 * Represents a grid layer.
 * GridLayer is a generic class for handling a tiled grid of HTML elements and is
 * the base class for all tile layers .
 */
class GridLayer extends Layer
{
    /**
     * Generates the object's JavaScript code
     *
     * @param Map $map The map widget
     * @return JsExpression Object JavaScript code
     */
    public function toJs($map)
    {
        return $this->toJsExpression("{$map->leafletVar}.gridLayer({$map->options2Js($this->options)})".$map->events2Js($this->events));
    }
}
