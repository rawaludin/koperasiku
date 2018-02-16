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
}
