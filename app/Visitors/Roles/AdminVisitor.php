<?php

namespace App\Visitors\Roles;

use App\Models\Shipment;
use App\Models\User;
use App\Visitors\Visitor;
use Illuminate\Support\Facades\Log;


class AdminVisitor implements Visitor
{
    public function visitShipment(Shipment $shipment)
     {

        $statuses = ['Processing', 'Shipped', 'Delivered', 'Returned'];
        $randomStatus = $statuses[array_rand($statuses)];

        $shipment->status = $randomStatus;
        $shipment->save();

        Log::info("Shipment {$shipment->tracking_number} status randomly updated to '{$shipment->status}' by Admin.");

    }

    public function visitUser(User $user) 
    {
        $motivationalQuotes = [
            'Keep up the great work!',
            'You are doing an amazing job!',
            'Keep pushing forward!',
        ];
        $randomQuote = $motivationalQuotes[array_rand($motivationalQuotes)];
    
        $user->profile_message = $randomQuote;
        $user->save();
    
        Log::info("Admin updated User {$user->name}'s profile with a motivational message: '{$randomQuote}'.");
    }
}