<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allergen extends Model
{
    use HasFactory;

    protected $fillable = [
        'allergen',
        'allergen_id',
    ];

    public function products()
    {
        return $this->BelongsToMany(Product::class);
    }
}
