<?php

namespace App\Models;

use App\Enums\BannerType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Properties extends Model
{
    use SoftDeletes;

    protected $table = 'properties';

    protected $primarykey = 'id';

    protected $guarded = [];

    protected $casts = [
        'main_section' => BannerType::class,
    ];

    public function agent()
    {
        return $this->hasOne(Agents::class, 'id', 'agent_id');
    }

    // Add new one with a safe name
    public function agentRelation()
    {
        return $this->belongsTo(\App\Models\Agents::class, 'agent_id');
    }

    //todo:remove ambigious method after checking uses
    public function agents()
    {
        return $this->hasOne(Agents::class, 'id', 'agent_id');
    }

    public function property_amenities()
    {
        return $this->hasMany(PropertyAmenities::class, 'property_id', 'id');
    }

    public function property_images()
    {
        return $this->hasMany(Property_images::class, 'property_id', 'id');
    }

    public function property_videos()
    {
        return $this->hasMany(Property_videos::class, 'property_id', 'id');
    }

    public function property_matterports()
    {
        return $this->hasMany(Property_matterport::class, 'property_id', 'id');
    }

    public function propertyImages()
    {
        return $this->hasMany(Property_images::class, 'property_id');
    }

    public function property_floorplans()
    {
        return $this->hasMany(PropertyFloorplans::class, 'property_id', 'id');
    }

    public function state()
    {
        return $this->hasOne(States::class, 'state_id', 'state_id');
    }

    public function country()
    {
        return $this->hasOne(Countries::class, 'country_id', 'country_id');
    }

    public function property_documents()
    {
        return $this->hasMany(PropertyDocuments::class, 'property_id', 'id');
    }

    public function property_sliders()
    {
        return $this->hasMany(PropertySlider::class, 'property_id', 'id');
    }

    public function property_galleries()
    {
        return $this->hasMany(PropertyGalleries::class, 'property_id', 'id');
    }

    public function isPublished(): bool
    {
        return $this->published && $this->expires_at && $this->expires_at > now();
    }
}
