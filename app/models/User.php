<?php

// app/models/User.php

namespace App\Models;
use App\Exceptions\NotFoundException;

class User extends Model
{
    public string $id;
    public ?string $name = null;
    public ?string $email = null;
    public ?string $password = null;
    public ?bool $isAdmin = false;
}
