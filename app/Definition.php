<?php

namespace App;

use Carbon\Carbon;

class Definition extends Model
{
    protected $guarded = [];

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    public function getStartTimeAttribute()
    {
        return carb($this->attributes['start_time']);
    }

    public function getEndTimeAttribute()
    {
        return carb($this->attributes['end_time']);
    }

    public function shiftOnDate($date)
    {
        return $this->shifts()->firstOrNew([
            'date' => carb($date)->toDateString()
        ]);
    }

    public static function scopeAllExcept($query, $ids) {
        foreach ($ids as $id) {
            $query->where('id', '<>', $id);
        }

        return $query;
    }
}