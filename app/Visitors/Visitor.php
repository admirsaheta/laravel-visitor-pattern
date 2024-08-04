<?php

namespace App\Visitors;

use App\Models\Shipment;
use App\Models\User;

interface Visitor
{
    public function visitShipment(Shipment $shipment);
    public function visitUser(User $user);
}
