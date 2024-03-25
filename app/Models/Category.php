<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    #To get the number of categories for each post
    public function categoryPost()
    {
        return $this->hasMany(CategoryPost::class);
    }
}
