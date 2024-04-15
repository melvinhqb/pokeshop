<?php

// app/models/Cart.php

namespace App\Models;

class Cart extends Model
{
    public int $userId;
    public string $cardId;
    public int $quantity;
}
