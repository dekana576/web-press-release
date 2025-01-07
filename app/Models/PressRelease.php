<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressRelease extends Model
{
    use HasFactory;

    protected $table = "press_release";

    protected $fillable = [
        'press_name',
        'description',
        'image',
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
        'link_baliprawara',
        'link_baliwara',
        'link_balipost',
        'link_other',
        'date',

    ];
}
