<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialInstitutionBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'financial_institution_id',
        'balance',
        'date',
    ];

    public function financialInstitution()
    {
        return $this->belongsTo(FinancialInstitution::class);
    }
}
