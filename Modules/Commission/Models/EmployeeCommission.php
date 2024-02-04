<?php

namespace Modules\Commission\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCommission extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'commission_id'];

    protected static function newFactory()
    {
        return \Modules\Commission\Database\factories\EmployeeCommissionFactory::new();
    }

    public function mainCommission()
    {
        return $this->belongsTo(Commission::class, 'commission_id');
    }
}
