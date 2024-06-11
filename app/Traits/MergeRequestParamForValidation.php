<?php

namespace App\Traits;

trait MergeRequestParamForValidation
{
    public function validationData()
    {
        return $this->route()->parameters() + $this->all();
    }
}