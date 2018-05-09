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
        return Carbon::parse(
            $this->attributes['start_time']
        );
    }

    public function getEndTimeAttribute()
    {
        return Carbon::parse(
            $this->attributes['end_time']
        );
    }

    public function shiftOnDate($date)
    {
        return $this->shifts()->firstOrNew([
            'date' => ($date instanceof Carbon ? $date->toDateString() : $date)
        ]);
    }

    public static function scopeAllExcept($query, $ids) {
        foreach ($ids as $id) {
            $query->where('id', '<>', $id);
        }

        return $query;
    }
}