<?php

function create($model, $attributes = [], $amount = null)
{
    if (is_string($attributes)) {
        return factory($model, $amount)->states(explode(' ', $attributes))->create();
    }

    return factory($model, $amount)->create($attributes);
}