<?php

namespace App\Visitors\Roles;

use App\Models\Shipment;
use App\Models\User;
use App\Visitors\Visitor;

class GuestVisitor implements Visitor
{
    public function visitShipment(Shipment $shipment)
    {
        return $shipment->status;
    }

    public function visitUser(User $user)
    {
        return $user->id;
    }
}