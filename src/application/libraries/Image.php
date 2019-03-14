<?php
/**
 * Created by PhpStorm.
 * User: cskncms
 * Date: 6.05.2018
 * Time: 14:14
 */

require_once(APPPATH . "/third_party/SimpleImage.php");

class Image
{

    public function image_instance()
    {
        return new SimpleImage();
    }

}