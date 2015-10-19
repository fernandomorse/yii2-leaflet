<?php
/**
* PluginInterface file
*
* @author    Chris Yates
* @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
* @license   BSD 3-Clause
* @package   Leaflet.Plugins
*/

namespace beastbytes\leaflet\plugins;

/**
* PluginInterface
*/
interface PluginInterface
{
    /**
     * Registers the plugin
     *
     * @param yii\web\View $view The view
     */
    public function register($view);

    /**
     * Generates the object's JavaScript code
     *
     * @param Map $map The map widget
     * @return JsExpression Object JavaScript code
     */
    public function toJs($map);
}
