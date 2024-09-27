<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Vendor extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use HasFactory;
    protected $fillable = ['id','userId','utype','vendor_name','vendor_pan', 'vendor_gstin','vendor_gst_type', 'vendor_email','vendor_phone','cont_per_name','cont_per_number','cont_per_email','special_note','billing_name','billing_address1','billing_address2','billing_country','billing_state','billing_city','billing_pincode','shipping_name','shipping_address1','shipping_address2','shipping_country','shipping_state','shipping_city','shipping_pincode','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];
    public static function vendor_detail($id = 0)
    {
        $sql   =   DB::table('vendors AS vend')
                ->select('vend.id AS vendor_id', 'vend.vendor_priority', 'vend.vendor_name', 'vend.vendor_pan', 'vend.vendor_gstin', 'vend.vendor_gst_type', 'vend.vendor_email', 'vend.vendor_phone', 'vend.cont_per_name', 'vend.cont_per_number', 'vend.cont_per_email', 'vend.special_note', 'vend.billing_name', 'vend.billing_address1', 'vend.billing_address2', 'vend.billing_country', 'vend.billing_state', 'vend.billing_city', 'vend.billing_pincode', 'vend.shipping_name', 'vend.shipping_address1', 'vend.shipping_address2', 'vend.shipping_country', 'vend.shipping_state', 'vend.shipping_city', 'vend.shipping_pincode', 'vbd.bank_name', 'vbd.bank_branch', 'vbd.acc_holder_name', 'vbd.acc_number', 'vbd.acc_ifsc', 'vbd.acc_upi_id')
                ->join('vendor_bank_details AS vbd', 'vend.id', 'vbd.vendor_id')
                ->where('vend.id', $id);
        $data   =   $sql->get();
        return $data;
    }
}
