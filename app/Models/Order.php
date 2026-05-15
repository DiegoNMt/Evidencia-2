<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\OrderPhoto;

class Order extends Model
{
     use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'customer_id',
        'order_date',
        'status',
        'description',
        'processed_by',
        'delivered_by'
    ];

    protected $dates = [
        'order_date',
        'deleted_at'
    ];

    // Relationships with Customer, Users, and OrderPhotos
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function warehouseUser()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function routeUser()
    {
        return $this->belongsTo(User::class, 'delivered_by');
    }

    public function photos()
    {
        return $this->hasMany(OrderPhoto::class);
    }
}
