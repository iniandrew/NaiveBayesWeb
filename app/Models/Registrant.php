<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'school',
        'major',
        'mean_smt_4',
        'mean_smt_5',
        'status',
    ];

    PUBLIC CONST STATUS_GRADUATED = 'graduated';
    PUBLIC CONST STATUS_NOT_GRADUATED = 'not_graduated';
}
