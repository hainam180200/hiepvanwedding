<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'guest';
    protected $fillable = [
		'name',
		'type',
        'link',
        'url_display'
	];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
