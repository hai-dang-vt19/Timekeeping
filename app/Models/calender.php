<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calender extends Model
{
    use HasFactory;
    public $table = 'calender';
    protected $fillable = [
        'id_user',
        'ip',
        'address',
        'telecom_operator',
        'lat_lon'
    ];
}
