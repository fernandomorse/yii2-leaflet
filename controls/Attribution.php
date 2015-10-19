<?php
/**
 * Attribution Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Controls
 */

namespace beastbytes\leaflet\controls;

/**
 * Represents an attribution control
 */
class Attribution extends Control
{
    /**
     * @property array events Events for the Attribution control
     * @property JsExpression jsVar JavaScript variable name for the Attribution
     * control. If set the Attribution control is assigned to this variable
     * @property array options Options for the Attribution control
     */

    /**
     * Generates the object's JavaScript code
     *
     * @param Map $map The map widget
     * @return JsExpression Object JavaScript code
     */
    public function toJs($map)
    {
        return $this->toJsExpression("{$map->leafletVar}.control.attribution({$map->options2Js($this->options)})");
    }
}
