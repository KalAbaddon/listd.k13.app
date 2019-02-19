<?php
namespace Grav\Plugin;

use Grav\Common\GravTrait;
use RocketTheme\Toolbox\File\File;
use Symfony\Component\Yaml\Yaml;

class FetchComments
{
    use GravTrait;

    /**
     * Get taxonomy list.
     *
     * @return array
     */
    public function get($route)
    {
        return $this->fetchComments($route);
    }

    /**
     * @internal
     */

    /**
     * Return the comments associated to the current route
     */
    private function fetchComments($route) 
    {
        $lang = self::getGrav()['language']->getLanguage();
        $filename = $lang ? '/' . $lang : '';
        $filename .= $route . '.yaml';
        return $this->getDataFromFilename($filename)['comments'];
    }

    /**
     * Given a data file route, return the YAML content already parsed
     */
    private function getDataFromFilename($fileRoute) 
    {
        //Single item details
        $fileInstance = File::instance(DATA_DIR . 'comments/' . $fileRoute);
        if (!$fileInstance->content()) {
            //Item not found
            return;
        }
        return Yaml::parse($fileInstance->content());
    }
}
