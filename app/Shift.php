<?php

namespace App;

use App\Exceptions\MultipleShiftAssignmentException;
use Carbon\Carbon;

class Shift extends Model
{
    protected $guarded = [];

    protected $with = ['definition'];

    protected $dates = ['create_at', 'updated_at', 'date'];

    protected static function boot()
    {
        static::creating(function ($shift) {
            $params = [
                'date' => $shift->date,
                'definition_id' => $shift->definition_id,
            ];

            if (Shift::where($params)->exists()) {
                throw new MultipleShiftAssignmentException;
            }
        });
    }

    public function definition()
    {
        return $this->belongsTo(Definition::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function getDateAttribute()
    {
        return Carbon::parse(
            $this->attributes['date']
        )->setTime(0, 0, 0);
    }

    public static function allForDate($date)
    {
        return static::where('date', $date)->get();
    }
}