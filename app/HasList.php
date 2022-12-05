<?php

namespace App;


trait HasList
{
    public function list()
    {
        return self::published()->orderBy('position', 'ASC')->get();
    }
}
