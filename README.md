# Visitor Design Pattern in PHP

The Visitor Design Pattern is a behavioral design pattern that allows you to separate an algorithm from the objects on which it operates. This pattern helps in adding new operations without modifying the existing object structures. It is particularly useful when you want to perform operations across a set of objects that share a common interface.

## Prerequisites

- Basic understanding of PHP and Laravel.
- Familiarity with Object-Oriented Programming (OOP) concepts.

## Terminology

- **Design Pattern:** A general, reusable solution to a commonly occurring problem in software design.

## The Visitor Design Pattern in PHP: The Issue

Consider a scenario where you have different types of objects, such as `Shipment` and `User`, and you want to perform various operations on them. Without the Visitor pattern, if you need to add new operations, you would have to modify the classes for each type.

### Example Without Visitor Pattern

```php
// app/Models/Shipment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = ['tracking_number', 'sender', 'receiver', 'status'];

    public function markAsProcessed()
    {
        $this->status = 'Processed';
        $this->save();
    }
}

// app/Models/User.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role'];

    public function activate()
    {
        $this->status = 'Active';
        $this->save();
    }
}
```
To add a new operation like archive, you would need to modify each class.

The Visitor Design Pattern in PHP: The Solution
Using the Visitor pattern, you can separate operations from the classes on which they operate. Here’s how you can implement it:

Define the Visitor Interface
```php
// app/Visitors/Visitor.php
namespace App\Visitors;

use App\Models\Shipment;
use App\Models\User;

interface Visitor
{
    public function visitShipment(Shipment $shipment);
    public function visitUser(User $user);
}
```
Implement concrete visitors e.g 
```php
// app/Visitors/AdminVisitor.php
namespace App\Visitors;

use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdminVisitor implements Visitor
{
    public function visitShipment(Shipment $shipment)
    {
        $shipment->status = 'Managed by Admin');
        $shipment->save();
        Log::info("Shipment {$shipment->tracking_number} status updated to '{$shipment->status}' by Admin.");
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
```
Update models to accept visitors
```php
// app/Models/Shipment.php
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

// app/Models/User.php
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
```
Using it
```php
// app/Http/Controllers/ShipmentController.php
namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Visitors\AdminVisitor;

class ShipmentController extends Controller
{
    public function update(Shipment $shipment)
    {
        $visitor = new AdminVisitor();
        $shipment->accept($visitor);

        return response()->json(['status' => 'Shipment updated successfully.']);
    }
}
```
The Visitor Design Pattern provides a flexible way to add new operations to object structures without modifying the objects themselves. This pattern is especially useful for handling operations across a set of objects and maintaining code that is both modular and extensible.
