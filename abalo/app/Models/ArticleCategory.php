<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $ab_name
 * @property string|null $ab_description
 * @property int|null $ab_parent
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticleCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticleCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticleCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticleCategory whereAbDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticleCategory whereAbName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticleCategory whereAbParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticleCategory whereId($value)
 * @mixin \Eloquent
 */
class ArticleCategory extends Model
{
    protected $table = 'ab_articlecategory';

    //M4-Aufgabe5
    public function articles(){
        return $this->belongsToMany(Article::class);
    }
}
