<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'about',
        'price',
        'image',
        'category',
        'archived',
        'deleted',
    ];

    public function allergens()
    {
        return $this->BelongsToMany(Allergen::class);
    }
}
