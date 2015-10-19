<?php
/**
* LeafletAsset Class file
*
* @author    Chris Yates
* @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
* @license   BSD 3-Clause
* @package   Leaflet
*/

namespace beastbytes\leaflet;

use yii\web\AssetBundle;

/**
* LeafletAsset Class
*
* Asset bundle for Leaflet
*/
class LeafletAsset extends AssetBundle
{
	public $basePath   = '@webroot';
    public $css        = ['leaflet.css'];
	public $sourcePath = '@beastbytes/leaflet/assets';

    public function init()
    {
        $this->js = (defined('YII_DEBUG') && YII_DEBUG
            ? ['leaflet-src.js']
            : ['leaflet.js']
        );
    }
}
