<?php
namespace Grav\Plugin;

use \Grav\Common\Plugin;
use \Grav\Common\Grav;
use \Grav\Common\Page\Page;

class UikitifierPlugin extends Plugin
{
    protected $route = 'uikitifier';

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize configuration
     */
    public function onPluginsInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;
        }

        $load_events = false;

        // if not always_load see if the theme expects to load the uikitifier plugin
        if (!$this->config->get('plugins.uikitifier.always_load')) {
            $theme = $this->grav['theme'];
            if (isset($theme->load_uikitifier_plugin) && $theme->load_uikitifier_plugin) {
                $load_events = true;
            }
        } else {
            $load_events = true;
        }

        if ($load_events) {
            $this->enable([
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
                'onTwigTemplatePaths' => ['onTwigAdminTemplatePaths', 0],
                'onAdminMenu' => ['onAdminMenu', 0],
                'onDataTypeExcludeFromDataManagerPluginHook' => ['onDataTypeExcludeFromDataManagerPluginHook', 0],
            ]);
        }
    }

    /**
     * if enabled on this page, load the JS + CSS and set the selectors.
     */
    public function onTwigSiteVariables()
    {
        require_once __DIR__ . '/classes/fetchComments.php';

        $config = $this->config->get('plugins.uikitifier');
        $mode = $config['mode'] == 'production' ? '.min' : '';

        $uikitifier_bits = [];

        if ($config['load_all'] or $config['load_uikit']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/uikit'.$mode.'.js';
            $uikitifier_bits[] = 'plugin://uikitifier/css/uikit'.$mode.'.css';
        }

        if ($config['style'] == 'almost-flat') {
            $uikitifier_bits[] = 'plugin://uikitifier/css/uikit.almost-flat'.$mode.'.css';
        }

        if ($config['style'] == 'gradient') {
            $uikitifier_bits[] = 'plugin://uikitifier/css/uikit.gradient'.$mode.'.css';
        }

        if ($config['load_all'] or $config['load_component_sticky']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/sticky'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/sticky.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/sticky.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/sticky'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_accordion']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/accordion'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/accordion.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/accordion.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/accordion'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_search']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/search'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/search.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/search.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/search'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_autocomplete']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/autocomplete'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/autocomplete.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/autocomplete.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/autocomplete'.$mode.'.css';
            }   
        }


        if ($config['load_all'] or $config['load_component_cover']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/cover'.$mode.'.js';
        }

        if ($config['load_all'] or $config['load_component_datepicker']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/datepicker'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/datepicker.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/datepicker.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/datepicker'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_dotnav']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/dotnav'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/dotnav.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/dotnav.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/dotnav'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_form_advanced']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/form-advanced'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/form-advanced.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/form-advanced.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/form-advanced'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_form_file']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/form-file'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/form-file.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/form-file.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/form-file'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_form_password']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/form-password'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/form-password.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/form-password.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/form-password'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_form_select']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/form-select'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/form-select.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/form-select.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/form-select'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_grid']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/grid'.$mode.'.js';
        }

        if ($config['load_all'] or $config['load_component_htmleditor']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/htmleditor'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/htmleditor.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/htmleditor.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/htmleditor'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_lightbox']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/lightbox'.$mode.'.js';
        }

        if ($config['load_all'] or $config['load_component_nestable']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/nestable'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/nestable.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/nestable.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/nestable'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_notify']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/notify'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/notify.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/notify.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/notify'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_pagination']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/pagination'.$mode.'.js';
        }

        if ($config['load_all'] or $config['load_component_placeholder']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/placeholder'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/placeholder.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/placeholder.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/placeholder'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_progress']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/progress'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/progress.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/progress.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/progress'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_slidenav']) {
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/slidenav.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/slidenav.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/slidenav'.$mode.'.css';
            }   
        }


        if ($config['load_all'] or $config['load_component_slideshow']) {
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/slideshow.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/slideshow.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/slideshow'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_slideshow-fx']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/slideshow-fx'.$mode.'.js';
        }

        if ($config['load_all'] or $config['load_component_sortable']) {
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/sortable.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/sortable.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/sortable'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_timepicker']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/timepicker'.$mode.'.js';
        }

        if ($config['load_all'] or $config['load_component_tooltip']) {
            $uikitifier_bits[] = 'plugin://uikitifier/js/components/tooltip'.$mode.'.js';
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/tooltip.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/tooltip.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/tooltip'.$mode.'.css';
            }   
        }

        if ($config['load_all'] or $config['load_component_upload']) {
            if ($config['style'] == 'almost-flat') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/upload.almost-flat'.$mode.'.css';
            } elseif ($config['style'] == 'gradient') {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/upload.gradient'.$mode.'.css';
            } else {
                $uikitifier_bits[] = 'plugin://uikitifier/css/components/upload'.$mode.'.css';
            }   
        }

        $assets = $this->grav['assets'];
        $assets->registerCollection('uikit', $uikitifier_bits);
        $assets->add('uikit', 100);

        

        $twig = $this->grav['twig'];
        $twig->twig_vars['fetchComments'] = new FetchComments();
    }

     /**
     * Add templates directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }
    /**
     * Add plugin templates path
     */
    public function onTwigAdminTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/admin/templates';
    }
    /**
     * Add navigation item to the admin plugin
     */
    public function onAdminMenu()
    {
        $this->grav['twig']->plugins_hooked_nav['UIKitifier'] = ['route' => $this->route, 'icon' => 'fa-gears'];
    }
    /**
     * Exclude uikitifier from the Data Manager plugin
     */
    public function onDataTypeExcludeFromDataManagerPluginHook()
    {
        $this->grav['admin']->dataTypesExcludedFromDataManagerPlugin[] = 'uikitifier';
    }    

}