<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    protected $table = 'customer';
    protected $primaryKey = 'cst_id';

    protected $fillable = [
        'cst_id', 'cst_name', 'cst_dob', 'nationality_id', 'cst_phoneNum', 'cst_email'
    ];

    public function nationality(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Nationality::class);
    }

    public function families(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FamilyList::class, 'cst_id');
    }
}
