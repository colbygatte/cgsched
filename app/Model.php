<?php

namespace App;

class Model extends \Illuminate\Database\Eloquent\Model
{
    public function route($action = 'show')
    {
        return model_route($this, $action);
    }

    public function getAttributeValues($values)
    {
        $data = [];

        foreach ($values as $value) {
            $data[$value] = $this->getAttributeValue($value);
        }

        return $data;
    }
}