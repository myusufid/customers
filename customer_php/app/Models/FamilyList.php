<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyList extends Model
{
    use HasFactory;

    protected $table = 'family_list';

    protected $fillable = [
        'cst_id', 'fl_relation', 'fl_name', 'fl_dob'
    ];


    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class, 'cst_id');
    }
}
