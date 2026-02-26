<?php

namespace App\Modules\Setting\Models;

use App\Modules\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksUser;

class Setting extends Model
{
    use TracksUser;

    protected $appends = ['company_logo_url'];
    protected $guarded = [];

    public function getCompanyLogoUrlAttribute(): ?string
    {
        return $this->company_logo_path ? asset('storage/' . $this->company_logo_path) : null;
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
