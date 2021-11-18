<?php
//phpcs:disable
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property Carbon $date_create
 * @property Carbon $date_update
 * @property int $client_id
 * @property int $reseller_id
 * @property int $deliverer_id
 * @property int $role_id
 *
 * @package Foodticket\Models
 */
class ResellerUser extends Model
{
    /* use QueryCacheable; */

    public const CREATED_AT = 'date_create';
    public const UPDATED_AT = 'date_update';

    // public $chaceFor = 3600;
    // protected static $flushCacheOnUPdate = true;

    protected $casts = [
        'client_id' => 'int',
        'reseller_id' => 'int',
        'deliverer_id' => 'int',
        'rove_id' => 'int',
    ];

    protected $dates = [
        'date_create',
        'date_update',
        'email_verified_at',
    ];

    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'name',
        'email',
        'remember_token',
        'login',
        'password',
        'otp_secret',
        'tel',
        'push',
        'rights',
        'subjects',
        'reseller_id',
    ];

    private static $subjectFields = [
        'oneone' => 1,
        'two' => 2,
        'fourteen' => 14,
        'three' => 3,
        'twelve' => 12,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'thirteen' => 13,
        'nine' => 9,
        'ten' => 10,
        'eleven' => 11,
    ];

    private static $rightFields = [
        'admin',
        'clients',
        'clients_edit',
        'clients_o',
        'clients_download',
        'clients_delete_order_nc',
        'clients_table_online',
        'clients_table_apps',
        'clients_table_n',
        'clients_table_fin',
        'todo',
        'hardware',
        'hardware_check',
        'prospects',
        'messages',
        'invoices',
        'salesinfo',
        'reseller',
        'users',
        'incasso',
        'excasso',
        'settings',
    ];

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }

    public function scopeGetResellerUserList($query)
    {
        return $query->where('deleted', 0);
    }

    public static function joinSubjects(array $subjects): string
    {
        $selectedSubjects = [];

        foreach ($subjects as $key => $value) {
            if ($value && isset(self::$subjectFields[$key])) {
                $selectedSubjects[] = self::$subjectFields[$key];
            }
        }
        return implode(' ', $selectedSubjects);
    }

    public static function splitSubjects(string $subjects): array
    {
        $subjectMap = array_flip(self::$subjectFields);
        return array_map(static function (string $subject) use ($subjectMap) {
            return $subjectMap[(int) $subject];
        }, explode(' ', $subjects));
    }

    public static function joinRights(array $rights): string
    {
        $selectedRights = [];

        foreach ($rights as $key => $value) {
            if ($value && $key === 'admin') {
                $selectedRights = ['admin'];
                break;
            }
            if ($value && in_array($key, self::$rightFields, true)) {
                $selectedRights[] = $key;
            }
        }
        return implode(' ', $selectedRights);
    }

    public static function splitRights(string $rights): array
    {
        return explode(' ', $rights);
    }
}
