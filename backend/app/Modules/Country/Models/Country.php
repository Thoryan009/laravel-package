<?php

namespace App\Modules\Country\Models;

use App\Modules\Auth\Models\User;
use App\Modules\Client\Models\Client;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksUser;

class Country extends Model
{
    use TracksUser;

    protected $guarded = [];
    public function clients()
    {
        return $this->hasMany(Client::class);
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
