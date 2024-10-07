<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Websitelinck extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'websitelincks';

    protected $fillable = [
        'url',
        'title_selector',
        'content_selector',
        'content_wrapper',
        'detail_page_content_selector',
        'image_url',
        'type_opportunity_id',
        'prescripteur_id',
        'pays_partner_id'
    ];
}
