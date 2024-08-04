<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Visitors\Visitor;

class Shipment extends Model
{
    protected $fillable = ['tracking_number', 'sender', 'receiver', 'status'];

    public function accept(Visitor $visitor)
    {
        $visitor->visitShipment($this);
    }
}