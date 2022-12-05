<?php

namespace App;


trait HasValue
{
    public function getValue()
    {
        return $this->published()->orderBy('position', 'ASC')->first();
    }
}
