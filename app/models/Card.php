<?php

// app/models/Card.php

namespace App\Models;

use App\Models\Set;

class Card extends Model
{
    public ?string $id = null;
    public ?string $category = null;
    public ?string $illustrator = null;
    public ?string $image = null;
    public ?string $localId = null;
    public ?string $name = null;
    public ?string $rarity = null;
    public ?string $types = null;
    public ?string $evolveFrom = null;
    public ?string $description = null;
    public ?string $stage = null;
    public ?string $attacks = null;
    public ?string $weaknesses = null;
    public ?string $retreat = null;
    public ?string $regulationMark = null;
    public ?string $legal = null;
    public ?string $variants = null;
    public ?string $hp = null;
    public int $stock = 0;
    public float $price = 0.0;
    public Set $set;
}
