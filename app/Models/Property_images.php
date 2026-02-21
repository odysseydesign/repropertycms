<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property_images extends Model
{
    use HasFactory;

    protected $table = 'property_images';

    protected $primarykey = 'id';

    protected $guarded = [];
}
