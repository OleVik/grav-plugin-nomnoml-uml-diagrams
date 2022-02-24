<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

/**
 * Shortcode with Nomnoml-library
 *
 * Class NomnomlShortcode
 * 
 * @package Grav\Plugin\NomnomlUMLDiagramsPlugin
 * @return  string HTML- and Script-tags
 * @license MIT License by Ole Vik
 */
class NomnomlShortcode extends Shortcode
{
    /**
     * Initialize shortcode
     * 
     * @return string HTML- and Script-tags
     */
    public function init()
    {
        $this->shortcode->getHandlers()->add(
            'nom', function (ShortcodeInterface $sc) {
                $config = $this->grav['config']->get('plugins.nomnoml-uml-diagrams');
                if (isset($config['defaultoptions'])) {
                    $defaults = $config['defaultoptions'];
                }
                $hash = md5(random_bytes(5));
                $content = $sc->getContent();
                $content = htmlspecialchars_decode($content);
                $content = str_replace('<h1>', '#', $content);
                $content = str_replace(['<p>', '</p>', '</h1>'], '', $content);
                if ($sc->getParameter('default') != 'false' && !empty($defaults)) {
                    $options = '';
                    foreach ($defaults as $key => $value) {
                        $options .= '#' . $key . ': ' . $value . "\n";
                    }
                    $content = $options . $content;
                }
                $output = '<canvas id="target_' . $hash . '"></canvas>';
                $output .= '<script id="nomnoml_' . $hash . '" type="text/plain">';
                $output .= $content;
                $output .= '</script>';
                $output .= '<script>';
                $output .= 'window.addEventListener("load", function(){';
                $output .= 'var canvas = document.getElementById("target_' . $hash . '");';
                $output .= 'var source_' . $hash . ' = document.getElementById("nomnoml_' . $hash . '");';
                $output .= 'var source_' . $hash . ' = source_' . $hash . '.innerHTML;';
                $output .= 'nomnoml.draw(canvas, source_' . $hash . ');';
                $output .= '});';
                $output .= '</script>';
                return $output;
            }
        );
    }
}
