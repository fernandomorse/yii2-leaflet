<?php
/**
* FullscreenAsset Class file
*
* @author    Chris Yates
* @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
* @license   BSD 3-Clause
* @package   Fullscreen
*/

namespace beastbytes\leaflet\plugins\fullscreen;

use yii\web\AssetBundle;

/**
* FullscreenAsset Class
*
* Asset bundle for Fullscreen plugin
*/
class FullscreenAsset extends AssetBundle
{
	public $basePath   = '@webroot';
    public $css        = ['Control.FullScreen.css'];
    public $js         = ['Control.FullScreen.js'];
	public $sourcePath = '@beastbytes/leaflet/plugins/fullscreen/assets';
}
