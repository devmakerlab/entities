<?php

namespace Entities;

trait Consistency
{
    public function isConsistent(): bool
    {
        foreach (get_object_vars($this) as $key => $value) {
            if (is_null($this->$key)) {
                return false;
            }
        }

        return true;
    }
}