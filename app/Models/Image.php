<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];

    /**
     * Get all of the models that own images.
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
