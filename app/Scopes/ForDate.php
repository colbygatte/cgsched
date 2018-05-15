<?php

namespace App\Scopes;

trait ForDate {
    public function scopeForDate($query, $date) {
        $date = carb($date);

        // This is for sqlite compatibility
        return $query->whereBetween('date', [
            (string) $date->subSecond(1),
            (string) $date->addSecond(2)
        ]);
    }
}