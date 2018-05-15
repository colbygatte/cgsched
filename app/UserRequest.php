<?php

namespace App;

use App\Scopes\ForDate;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use ForDate;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForDefinition($query, $definition)
    {
        return $query->where('definition_id', $definition instanceof Definition ? $definition->id : $definition);
    }
}
