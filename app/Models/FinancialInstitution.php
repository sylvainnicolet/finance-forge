<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialInstitution extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iban',
        'type',
    ];

    public function balances()
    {
        return $this->hasMany(FinancialInstitutionBalance::class);
    }
}
