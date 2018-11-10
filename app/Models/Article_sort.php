<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article_sort extends Model
{
    //
    protected $table = 'article_sort';
    protected $fillable = ['cat_name','introduction'];
}
