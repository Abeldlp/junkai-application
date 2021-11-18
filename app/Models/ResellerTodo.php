<?php
//phpcs:disable
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResellerTodo extends Model
{
    use HasFactory;
    /* use QueryCacheable; */

    /* public $cacheFor = 3600; */
    /* public $timestamps = false; */
    /* protected $table = 'reseller_todo'; */
    /* protected static $flushCacheOnUpdate = true; */
    
    protected $table = 'reseller_todo';

    protected $casts = [
        'prio' => 'int',
        'user_id' => 'int',
        'client_id' => 'int',
        'selectable' => 'int',
        '$todo_id' => 'int',
        'deleted' => 'int',
        'owner_id' => 'int',
    ];

    protected $dates = [
        'date_update',
        'date_done',
        'date_eta',
    ];

    public static $resellerTodoSubjects = [
        'Contract',
        'IBAN',
        'Domeinnaam',
        'Domeinnaam opzeggen',
        'Menukaart',
        'Actie',
        'Logo/vormgeving',
        'Flyer',
        'Apps',
        'TB Client Installeren',
        'OB installeren',
        'Web-formulier',
        'Anders namelijk',
    ];

    public static $resellerTodoPriority = [
        'Laag',
        'Normaal',
        'Hoog',
        'Urgent',
        'Spoed',
    ];

    protected $fillable = [
        'subject',
        'alt_subject',
        'status',
        'prio',
        'user_id',
        'client_id',
        'date_done',
        'message',
        'deleted',
        'owner_id',
        'depends_on',
        'date_create',
    ];

    protected $attributes = [
        'zendesk_id' => '',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function original($attribute, $default)
    {
        $original = $this->getOriginal($attribute);
        return $original ?: $default;
    }

    public function scopeGetSubject($query, $subject)
    {
        if (isset($subject)) {
            return $query->where('reseller_todo.subject', $subject);
        }
    }

    public function scopeGetStatus($query, $status)
    {
        if (isset($status)) {
            return $query->where('reseller_todo.status', $status);
        }
    }

    public function scopeGetPrio($query, $prio)
    {
        if (isset($prio)) {
            return $query->where('reseller_todo.prio', $prio);
        }
    }

    public function scopeGetUserId($query, $userId)
    {
        if (isset($userId)) {
            return $query->where('reseller_todo.user_id', $userId);
        }
    }
    public function scopeGetOwnerId($query, $ownerId)
    {
        if (isset($ownerId)) {
            return $query->where('reseller_todo.owner_id', $ownerId);
        }
    }

    public function scopeGetCompanyName($query, $client)
    {
        if (isset($client)) {
            return $query->where('clients.company', 'like', '%'.$client.'%');
        }
    }
}
