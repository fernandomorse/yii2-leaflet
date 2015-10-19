<?php
/**
 * LatLngTrait Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet.Types
 */

namespace beastbytes\leaflet\types;

/**
 * Common LatLng methods.
 */
trait LatLngTrait
{
    /**
     * @var LatLng
     */
    private $_latLng;

    /**
     * Creates a LatLng object from an array
     * The array can be in the format ['lat' => $lat, 'lng' => $lng] or [$lat, $lng]
     *
     * @param array $value The array with the LatLng values
     * @return LatLng
     */
    public function array2LatLng($value)
    {
        if (isset($value['lat'])) {
            return new LatLng($value);
        }

        return  new LatLng([
            'lat' => $value[0],
            'lng' => $value[1]
        ]);
    }

    /**
     * @return LatLng The geographical position of the object
     */
    public function getLatLng()
    {
        return $this->_latLng;
    }

    /**
     * Sets the geographical position of the object.
     * The value can be a LatLng object or an array in the form ['lat' => $lat, 'lng' => $lng] or [$lat, $lng]
     *
     * @param array|LatLng $value The marker's position
     * @throws InvalidConfigException If $value is not a LatLng object or an array that can be converted to one
     */
    public function setLatLng($value)
    {
        if (is_array($value)) {
            $value = $this->array2LatLng($value);
        }

        if (!($value instanceof LatLng)) {
            throw new InvalidConfigException('Invalid `position` attribute value; it must be a LatLng object or an array that can be converted to a LatLng object');
        }

        $this->_latLng = $value;
    }
}
