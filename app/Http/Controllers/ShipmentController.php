<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Visitors\Roles\AdminVisitor;
use App\Visitors\Roles\CustomerVisitor;
use App\Visitors\Roles\GuestVisitor;

class ShipmentController extends Controller {
    public function show(Shipment $shipment) {
        $visitor = $this->getVisitor();
        $status = $shipment->accept($visitor);

        return view('shipments.show', compact('shipment', 'status'));
    }

    private function getVisitor()
    {
        $role = auth()->user()->role ?? 'guest';

        switch ($role) {
            case 'admin':
                return new AdminVisitor();
            case 'customer':
                return new CustomerVisitor();
            default:
                return new GuestVisitor();
        }
    }
}
