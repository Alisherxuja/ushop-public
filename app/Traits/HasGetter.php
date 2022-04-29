<?php


namespace App\Traits;


use Illuminate\Support\Str;

trait HasGetter
{
    protected function mutateAttribute($key, $value)
    {
        $method = 'get' . Str::studly($key) . 'Attribute';
        $column = $key . '_' . \App::getLocale();
        $attributes = array_keys($this->getAttributes());
        if (method_exists($this, $method)) {
            return $this->{$method}($value);
        } elseif (in_array($column, $attributes)) {
            return $this->$column;
        }

        return null;
    }
}
