<?php
/**
* Fullscreen Class file
*
* @author    Chris Yates
* @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
* @license   BSD 3-Clause
* @package   Leaflet.Plugins.Fullscreen
*/

namespace beastbytes\leaflet\plugins\fullscreen;

use beastbytes\leaflet\controls\Control;
use beastbytes\leaflet\plugins\PluginInterface;

/**
* Fullscreen Class.
* Adda a fullscreen button to the map
*/
class Fullscreen extends Control implements PluginInterface
{
    /**
     * @property array events Events for the Fullscreen control
     * @property JsExpression jsVar JavaScript variable name for the Fullscreen
     * control. If set the Fullscreen control is assigned to this variable
     * @property array options Options for the Fullscreen control
     */

    /**
     * Registers the plugin
     *
     * @param yii\web\View $view The view
     */
    public function register($view)
    {
        FullscreenAsset::register($view);
    }

    /**
     * Generates the object's JavaScript code
     *
     * @param Map $map The map widget
     * @return JsExpression Object JavaScript code
     */
    public function toJs($map)
    {
        return $this->toJsExpression("{$map->leafletVar}.control.fullscreen({$map->options2Js($this->options)})");
    }
}
