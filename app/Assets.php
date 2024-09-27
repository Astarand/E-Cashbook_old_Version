<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;
	// protected $fillable = ['id', 'added_by','asset_name','branch_name','asset_cat','asset_sl_no','purchase_date','purchase_cost','warranty_period','opening_stock','opening_it_act','opening_comp_act','desc_it','desc_comp','created_at','updated_at'];
    protected $fillable = [
        'id',
        'added_by',
        'asset_id',
        'date',
        'asset_name',
        'assetType',
        'tangible_assets',
        'assets_description',
        'purchase_date',
        'purchase_cost',
        'shop_name',
        'invoice_number',
        'serial_number',
        'location_for',
        'department_for',
        'warranty_information',
        'maintenance_schedule',
        'insurance_details',
        'purchase_by',
        'purchase_date_audit',
        'approve_by',
        'documentation',
        'attachment',
        'approve_date',
        'created_at',
        'updated_at'
    ];
}
