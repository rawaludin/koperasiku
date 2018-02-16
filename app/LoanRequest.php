<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class LoanRequest extends Model
{
    protected $fillable = [
        'amount',
        'duration',
        'is_submitted',
        'is_approved',
        'member_id',
        'admin_id',
    ];

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function getStatusAttribute()
    {
        if ($this->is_approved) {
            return "Approved";
        }

        if (!$this->is_approved && $this->admin_id) {
            return "Rejected";
        }

        if ($this->is_submitted) {
            return "Waiting Approval";
        }

        if (!$this->is_submitted) {
            return "Draft";
        }
    }
}
