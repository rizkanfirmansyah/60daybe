<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory;
    use Timestamp;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'deleted_at', 'status', 'created_by'];
    protected $dates = ['deleted_at'];
}
