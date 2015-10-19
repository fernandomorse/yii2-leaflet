<?php
/**
 * Zoom Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Controls
 */

namespace beastbytes\leaflet\controls;

/**
 * Represents a zoom control
 */
class Zoom extends Control
{
    /**
     * @property array events Events for the Zoom control
     * @property JsExpression jsVar JavaScript variable name for the Zoom
     * control. If set the Zoom control is assigned to this variable
     * @property array options Options for the Zoom control
     */

    /**
     * Generates the object's JavaScript code
     *
     * @param Map $map The map widget
     * @return JsExpression Object JavaScript code
     */
    public function toJs($map)
    {
        return $this->toJsExpression("{$map->leafletVar}.control.zoom({$map->options2Js($this->options)})");
    }
}
