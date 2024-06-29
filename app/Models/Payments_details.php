<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payments;

class Payments_details extends Model
{
    use HasFactory;

    protected $table = 'payments_details';

    protected $primaryKey='id';

    protected $fillable = [
        'payment_id', 'curso_id', 'quantity', 'amount', 'currency', 'product_name', 'payer_name', 'payer_email', 'payment_status'
    ];

    public function payment()
    {
        return $this->belongsTo(Payments::class);
    }


}
