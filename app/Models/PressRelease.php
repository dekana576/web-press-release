<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressRelease extends Model
{
    use HasFactory;

    protected $fillable = [
        'press_name',
        'description',
        'link_kabarnusa',
        'link_baliportal',
        'link_updatebali',
        'link_pancarpos',
        'link_wartadewata',
        'link_baliexpress',
        'link_fajarbali',
        'link_balitribune',
        'link_radarbali',
        'link_dutabali',
        'link_baliekbis',
        'link_other',

    ];
}
