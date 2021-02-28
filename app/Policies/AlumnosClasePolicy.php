<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Maestro;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class AlumnosClasePolicy
{
    use HandlesAuthorization;

    public function alumnos(User $user,$maestro)
    {
        if($user->id == 3)
        {
            return false;
        }else{
            return true;
        }
    }
}
