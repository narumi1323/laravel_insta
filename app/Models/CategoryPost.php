<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = 'category_post';
    protected $fillable = ['category_id','post_id'];
    public $timestamps = false;

    #To get the name of the category
    public function category()
    {
        return $this ->belongsTo(Category::class);
    }
}

//中間テーブルやピポットテーブルの場合、Eloquent はデフォルトではモデル名からテーブル名を推測できないため、明示的に $table プロパティを使用してテーブル名を指定する必要があります。そのため、CategoryPost モデルではテーブル名を明示的に指定しています→この部分：protected $table = 'category_post';