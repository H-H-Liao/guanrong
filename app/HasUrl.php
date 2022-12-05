<?php

namespace App;


trait HasUrl
{
    public function url()
    {
        return $this->uri(app()->getLocale());
    }
}
