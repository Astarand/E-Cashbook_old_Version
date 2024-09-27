<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribers extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'uid','utype','pid','paid_amount','start_at','end_at','status','transaction_id','merchantTransactionId','payment_status','response_msg','providerReferenceId','merchantOrderId','checksum','paymentInstrument','created_at','updated_at'];
}
