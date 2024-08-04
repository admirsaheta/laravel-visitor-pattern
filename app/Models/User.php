<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Visitors\Visitor;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role'];

    public function accept(Visitor $visitor)
    {
        $visitor->visitUser($this);
    }
}