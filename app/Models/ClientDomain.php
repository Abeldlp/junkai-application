<?php
//phpcs:disable
namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Rennokki\QueryCache\Traits\QueryCacheable;

/**
 * Class Extra
 *
 * @property int $id
 * @property int $client_id
 * @property string $domain
 * @property int $deleted
 *
 * @package Foodticket\Models
 */
class ClientDomain extends Model
{
    /* use HasFactory; */
    /* use QueryCacheable; */

    public $cacheFor = 3600;
    public $timestamps = false;
    protected $table = 'client_domains';

    protected static $flushCacheOnUpdate = true;

    protected $fillable = [
        'client_id',
        'domain',
        'deleted',
    ];
}
