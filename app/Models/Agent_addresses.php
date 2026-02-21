<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent_addresses extends Model
{
    use HasFactory;

    protected $table = 'agent_addresses';

    protected $guarded = [];

    public function state()
    {
        return $this->hasOne(States::class, 'state_id', 'state_id');
    }

    public function country()
    {
        return $this->hasOne(Countries::class, 'country_id', 'country_id');
    }
}
