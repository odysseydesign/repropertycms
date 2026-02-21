<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';

    protected $primarykey = 'id';

    protected $guarded = [];

    public function subscriptions()
    {
        return $this->hasOne(Subscription::class, 'stripe_price', 'stripe_plan_id');
    }
}
