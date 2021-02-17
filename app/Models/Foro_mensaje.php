<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foro_mensaje extends Model
{
    use HasFactory;

    public function mensajeable_type()
    {
        return $this->morphTo();
    }
}
