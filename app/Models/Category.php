<?php
//phpcs:disable
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    /* use QueryCacheable; */

    // public $cacheFor = 3600;
    // public $timestamps = false;

    // protected static $flushCacheOnUpdate = true;

    protected $table = 'categories';

    protected $casts = [
        'client_id' => 'int',
        'deleted' => 'int',
        'prio' => 'int',
        'prio_counter' => 'int',
        'delivery' => 'int',
        'static_counter' => 'int',
        'tip' => 'int',
        'min_amount' => 'float',
        'vegan' => 'int',
        'spicy' => 'int',
        'auto_pop' => 'int',
        'auto_pop_n' => 'int',
        'parent_id' => 'int',
        'is_parent' => 'int',
        'delivery_costs' => 'float',
        'orig' => 'int',
        'min_age' => 'int',
    ];

    protected $fillable = [
        'client_id',
        'title',
        'description',
        'deleted',
        'prio',
        'title_counter',
        'prio_counter',
        'show_in',
        'start',
        'end',
        'days',
        'start_time',
        'end_time',
        'allergy',
        'delivery',
        'static_counter',
        'tip',
        'min_amount',
        'vegan',
        'spicy',
        'image',
        'import_id',
        'auto_pop',
        'auto_pop_n',
        'parent_id',
        'is_parent',
        'delivery_costs',
        'excl_zips',
        'orig',
        'show_type',
        'custom_vars',
        'sortby',
        'min_age',
        'color_counter',
    ];
    
    public function products(): HasMany
    {
        return $this->hasMany('Admin\Models\Product');
    }

    public function extras(): HasMany
    {
        return $this->hasMany('Admin\Models\Extra');
    }

    public function scopeClientId($query, $clientId)
    {
        return $query->where('client_id', $clientId);
    }

    public function scopeId($query, $categoryId)
    {
        return $query->where('id', $categoryId);
    }

    public function scopeDeleted($query, $deleted)
    {
        return $query->where('deleted', $deleted);
    }
}
