<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * 
 *
 * @property int $id Primärschlüssel
 * @property string $ab_name Name
 * @property string $ab_password Passwort
 * @property string $ab_email E-Mail-Adresse
 * @method static \Database\Factories\AbUserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AbUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AbUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AbUser query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AbUser whereAbEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AbUser whereAbName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AbUser whereAbPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AbUser whereId($value)
 * @mixin \Eloquent
 */
class AbUser extends Model
{
    use HasFactory;
    protected $table = 'ab_user';
    public $timestamps = false;
    protected $fillable = ['ab_name', 'ab_password', 'ab_email'];
}
