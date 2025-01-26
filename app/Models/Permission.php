<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Models\Permission as Model;

class Permission extends Model
{
    use HasUuids;
}
