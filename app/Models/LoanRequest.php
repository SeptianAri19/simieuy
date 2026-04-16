<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    protected $fillable = [
        'borrower_name',
        'organization',
        'inventory_id',
        'duration_days',
        'surat_link',
        'status',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}