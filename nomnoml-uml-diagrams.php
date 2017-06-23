<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;
 
/**
 * Shortcode for UML Diagrams with
 * Nomnoml-library
 *
 * Class NomnomlUMLDiagramsPlugin
 * @package Grav\Plugin
 * @return mixed Shortcode for UML Diagrams
 * @license MIT License by Ole Vik
 */
class NomnomlUMLDiagramsPlugin extends Plugin
{
    /**
     * Initialize plugin and subsequent events
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        /* Check if Admin-interface */
        if ($this->isAdmin()) {
            return;
        }
        
        /* Register events */
        $this->enable([
            'onAssetsInitialized' => ['init', 0],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0]
        ]);
    }

    /**
     * Create shortcode-handler
     * @param Event $e RocketTheme Event-handler
     * @return void
     */
    public function onShortcodeHandlers(Event $e)
    {
        $this->grav['shortcode']->registerShortcode('NomnomlShortcode.php', __DIR__);
    }

    /**
     * Initialize plugin assets
     * @return void
     */
    public function init()
    {
        $config = (array) $this->config->get('plugins.nomnoml-uml-diagrams');
        if ($config['builtin_css']) {
            $this->grav['assets']->addCss('plugin://nomnoml-uml-diagrams/css/codemirror.css', 110);
            $this->grav['assets']->addCss('plugin://nomnoml-uml-diagrams/css/solarized.nomnoml.css', 109);
        }
        if ($config['builtin_js']) {
            $this->grav['assets']->addJs('plugin://nomnoml-uml-diagrams/js/lodash.min.js', 110);
            $this->grav['assets']->addJs('plugin://nomnoml-uml-diagrams/js/dagre.min.js', 109);
            $this->grav['assets']->addJs('plugin://nomnoml-uml-diagrams/js/nomnoml.min.js', 108);
        }
    }
}
