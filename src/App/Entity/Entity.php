<?php

namespace App\Entity;


abstract class Entity
{
    /**
     * @return array
     */
    public function toArray()
    {
        $refl = get_object_vars($this);

        return array_filter($refl);
    }
}