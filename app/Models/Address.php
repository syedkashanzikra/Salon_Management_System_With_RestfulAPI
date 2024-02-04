<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'postal_code',
        'city',
        'state',
        'country',
        'latitude',
        'logitude',
        'address_line_1',
        'address_line_2',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
