<?php

// app/models/Set.php

namespace App\Models;

use App\Models\Serie;

class Set extends Model
{
    public string $id;
    public ?string $name = null;
    public ?string $releaseDate = null;
    public ?string $legal = null;
    public ?string $logo = null;
    public ?string $symbol = null;
    public ?string $cardCount = null;
    public ?array $cards = [];
    public Serie $serie;
}
