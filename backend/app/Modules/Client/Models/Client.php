<?php

namespace App\Modules\Client\Models;

use App\Modules\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksUser;

class Client extends Model
{
    use TracksUser;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function country()
    {
        return $this->belongsTo(\App\Modules\Country\Models\Country::class);
    }

    public function workOrders()
    {
        return $this->hasMany(\App\Modules\WorkOrder\Models\WorkOrder::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
