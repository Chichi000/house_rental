<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orderinfo';
 	protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = [
        'tenant_id', 
        'total_days', 
        'start_date', 
        'end_date', 
        'payment_method', 
        'total_amount', 
        'status'
    ];

    public function tenants() {
    	return $this->belongsTo('App\Models\Tenant', 'tenant_id');
    }

    public function properties() {
    	return $this->belongsToMany(Property::class,'orderline','orderinfo_id','property_id');
 	}

}
