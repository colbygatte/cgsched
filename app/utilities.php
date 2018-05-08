<?php

use Illuminate\Support\Str;

/**
 * @param $class
 * @param $action
 *
 * @return string
 */
function class_actionize($class, $action)
{
    $class = is_string($class) ? $class : get_class($class);

    return Str::lower(Str::plural(array_reverse(explode('\\', $class))[0])).".$action";
}

/**
 * @param $model
 * @param $action
 *
 * @return string
 */
function model_route($model, $action)
{
    static $hasId = ['show', 'edit', 'update', 'destroy'];

    return route(
        class_actionize($model, $action),
        in_array($action, $hasId) ? $model->id : null
    );
}

/**
 * @param $string
 *
 * @return \Carbon\Carbon
 */
function carb($string = null)
{
    return \Carbon\Carbon::parse($string);
}