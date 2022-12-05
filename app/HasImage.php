<?php

namespace App;


trait HasImage
{
    public function getImage()
    {
        if($this->image_id > 0){
            return $this->present()->image();
        }
        return asset('project/images/logo.png');
    }
}
