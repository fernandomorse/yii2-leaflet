<?php
/**
 * Map Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Leaflet
 */

namespace beastbytes\leaflet;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * A leaflet map
 */
class Map extends Widget
{
    const LEAFLET_VAR = 'L';

    /**
     * @var array Array of map controls
     */
    public $controls = [];

    /**
     * @var array Array of map layers
     */
    public $layers = [];

    /**
     * @var string The variable used by Leaflet. If this is not the default `L`
     * the noConflict() method is called and the new variable used for Leaflet.
     * WARNING: Some plugins require the default variable name for Leaflet.
     */
    public $leafletVar = self::LEAFLET_VAR;

    /**
     * @var array Map configuration options
     */
    public $mapOptions = [];

    /**
     * @var array HTML options for the container eleme
     *
     * The "tag" element specifies the tag name of the container element; it
     * defaults to "div".
     */
    public $options = [];

    /**
     * @var array Plugins
     */
    public $plugins = [];

    /**
    * @var string HTML container tag; defaults to 'div'
    */
    protected $tag;

    /**
     * @var array Events for the map. Each event is in the format $name => $handler
     */
    private $_events = [];

    /**
     * Initialises the widget
     *
     * @throws \yii\base\InvalidConfigException If mapOptions['center'] or mapOptions['zoom'] are not set
     */
    public function init()
    {
        if (!isset($this->mapOptions['center'])) {
            throw new InvalidConfigException('mapOptions["center"] must be set.');
        }

        if (!isset($this->mapOptions['zoom'])) {
            throw new InvalidConfigException('mapOptions["zoom"] must be set.');
        }

        if (isset($this->options['id'])) {
            $this->setId($this->options['id']);
        } else {
            $this->options['id'] = $this->getId();
        }

        parent::init();

        $this->tag = ArrayHelper::remove($this->options, 'tag', 'div');

        $this->registerScript();
    }

    /**
     * Runs the widget
     *
     * @return string HTML for the widget
     */
    public function run()
    {
        echo Html::tag($this->tag, '', $this->options);
    }

    /**
     * Gets the options
     *
     * @return array The options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets an event
     *
     * @param string $name Event name
     * @param string $handler Event handler.
     */
    public function setEvent($name, $handler)
    {
        $this->_events[$name] = $handler;
    }

    /**
     * Sets the events
     *
     * @param array $events Events for the object. Each event is in the format $name => $handler
     */
    public function setEvents($events)
    {
        foreach ($events as $name => $handler) {
            $this->setEvent($name, $handler);
        };
    }

    /**
     * Registers the JavaScript for the widget
     */
    protected function registerScript()
    {
        $view = $this->getView();

        LeafletAsset::register($view);

        foreach ($this->plugins as $plugin) {
            $plugin->register($view);
        }

        $js = $this->components2Js();

        array_unshift($js, "var {$this->id} = {$this->leafletVar}.map('{$this->id}', {$this->options2Js($this->mapOptions)});".$this->events2Js($this->_events));

        if ($this->leafletVar !== self::LEAFLET_VAR) {
            array_unshift($js, "var {$this->leafletVar} = ".self::LEAFLET_VAR.'.noConflict();');
        }

        $view->registerJs("function {$this->id}(){\n" . implode("\n", $js) . "}\n{$this->id}();");
    }

    /**
     * Generates JavaScript for map components; layers and controls
     *
     * @return \yii\web\JsExpression[] JavaScript for map components
     */
    private function components2Js()
    {
        $js = [];

        foreach (['layers', 'controls', 'plugins'] as $components) {
            foreach ($this->$components as $component) {
                if (!isset($component->map)) {
                    $component->map = $this->id;
                }

                $js[] = $component->toJs($this);
            };
        };

        return $js;
    }

    /**
     * Encodes events to JavaScript
     *
     * @param array $events The events to encode
     * @return string The encoded events
     */
    public function events2Js($events)
    {
        $js = '';

        foreach ($events as $name => $handler) {
            $js .= ".on('$name', $handler)";
        }

        return $js;
    }

    /**
     * Encodes options to JavaScript
     *
     * @param array $options The optione to encode
     * @return string The encoded options
     */
    public function options2Js($options)
    {
        foreach ($options as $key => $value) {
            if ($value instanceof Base) {
                $value = $value->toJs($this);
            } elseif (is_array($value) && $value[0] instanceof Base) {
                foreach ($value as $i => $v) {
                    $value[$i] = $v->toJs($this);
                }
            }

            $options[$key] = $value;
        }

        return empty($options) ? '{}' : Json::encode($options);
    }
}
