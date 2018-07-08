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
            $query = Shift::where([
                'date' => $shift->date,
                'definition_id' => $shift->definition_id
            ]);

            if ($query->exists()) {
                throw new MultipleShiftAssignmentException;
            }
        });
    }

    public function definition()
    {
        return $this->belongsTo(Definition::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function getUserIds()
    {
        return $this->users->pluck('id');
    }

    public function getDateAttribute()
    {
        return carb($this->attributes['date'])->setTime(0, 0, 0);
    }
}