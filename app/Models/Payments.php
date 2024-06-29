<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payments_details;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $primaryKey='id';


    protected $fillable = [
        'user_id', 'purchase_date', 'payment_method', 'payment_id'
    ];

    public function detallesPayment()
    {
        return $this->hasOne(Payments_details::class);
    }
}
