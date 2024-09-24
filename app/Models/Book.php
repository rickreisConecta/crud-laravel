<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $filable = ['title', 'id_user', 'pages', 'price'];

    public function relUsers()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }
}
