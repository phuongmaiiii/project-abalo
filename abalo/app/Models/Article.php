<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $ab_name
 * @property int $ab_price Preis in Cent
 * @property string $ab_description Beschreibung, die die Güte oder die Beschaffenheit näher
 *                             darstellt. Wird durch den „Ersteller“ (ab_user) gepflegt
 * @property int $ab_creator_id Referenz auf den/die Nutzer:in, der den Artikel erstellt hat und
 *                             verkaufen möchte
 * @property string $ab_createdate
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereAbCreatedate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereAbCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereAbDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereAbName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereAbPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereId($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    protected $table = 'ab_article';
    protected $fillable = ['ab_name', 'ab_price', 'ab_description', 'ab_createdate'];
    public $timestamps = false;

    public function cartItems(){
        return $this->hasMany(ShoppingCartItem::class, 'ab_article_id');
    }
}
