<?php
/**
 * PopupTrait Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Layers
 */

namespace beastbytes\leaflet\layers\ui;

/**
 * Provides bound Popup functionality
 */
trait PopupTrait
{
    /**
     * @var string Popup HTML content to display when on the bound component is
     * clicked
     */
    public $content;

    /**
     * Binds a popup if it has content
     *
     * @return string JavaScript the bind the popup
     */
    protected function popup()
    {
        $js = '';

        if (is_string($this->content)) {
            $content = addslashes($this->content);
            $js = ".bindPopup(\"$content\").openPopup()";
        }

        return $js;
    }
}
