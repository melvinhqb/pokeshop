<?php

// app/models/Serie.php

namespace App\Models;

class Serie extends Model
{
    public string $id;
    public ?string $name = null;
    public ?string $logo = null;
    public ?array $sets = [];
}
