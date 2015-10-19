<?php
/**
 * Control Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Controls
 */

namespace beastbytes\leaflet\controls;

use yii\helpers\Inflector;
use beastbytes\leaflet\layers\Layer;

/**
 * Represents a UI control on a map
 */
abstract class Control extends Layer
{
    /**
     * @var integer a counter used to generate jsVar
     */
    private static $_counter = 0;

    /**
     * Bottom left of the map.
     */
    const POSITION_BOTTOM_LEFT = 'bottomleft';
    /**
     * Bottom right of the map.
     */
    const POSITION_BOTTOM_RIGHT = 'bottomright';
    /**
     * Top left of the map.
     */
    const POSITION_TOP_LEFT = 'topleft';
    /**
     * Top right of the map.
     */
    const POSITION_TOP_RIGHT = 'topright';

    /**
     * Creates a JavaScript variable name for the object
     *
     * @param string Prefix for JavaScript variable name
     * @return string JavaScript variable name for the object
     */
    public function jsVar($prefix = '')
    {
        return Inflector::variablize($prefix.' '.basename(get_class()).self::$_counter++);
    }
}
