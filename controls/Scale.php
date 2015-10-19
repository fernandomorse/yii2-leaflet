<?php
/**
 * Scale Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Controls
 */

namespace beastbytes\leaflet\controls;

/**
 * Represents a scale control
 */
class Scale extends Control
{
    /**
     * @property array events Events for the Scale control
     * @property JsExpression jsVar JavaScript variable name for the Scale
     * control. If set the Scale control is assigned to this variable
     * @property array options Options for the Scale control
     */

    /**
     * Generates the object's JavaScript code
     *
     * @param Map $map The map widget
     * @return JsExpression Object JavaScript code
     */
    public function toJs($map)
    {
        return $this->toJsExpression("{$map->leafletVar}.control.scale({$map->options2Js($this->options)})");
    }
}
