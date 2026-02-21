<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFloorplans extends Model
{
    use HasFactory;

    protected $table = 'property_floorplans';

    protected $primarykey = 'id';

    protected $guarded = [];

    public function property_floorplan_images()
    {
        return $this->hasMany(PropertyFloorplanImages::class, 'property_floorplan_id', 'id');
    }

    public function hotspots()
    {
        return $this->hasMany(Hotspot::class);
    }
}
