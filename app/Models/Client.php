<?php
//phpcs:disable
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Admin\Http\Requests\Customers\CustomRules\NonDutchAccountWithBic;
use Admin\Http\Requests\Customers\CustomRules\NonDutchBank;

use Admin\Repositories\Adyen;

use Adyen\AdyenException;
use Foodticket\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
/* use Rennokki\QueryCache\Traits\QueryCacheable; */

class Client extends Model
{
    use HasFactory;
    /* use QueryCacheable; */

    // public int $cacheFor = 3600;
    /* public $timestamps = false; */

    // protected static bool $flushCacheOnUpdate = true;
    protected $table = 'clients';
    
    protected $casts = [
        'reseller_id' => 'int',
        'inv_same' => 'int',
        'deleted' => 'int',
        'https' => 'int',
        'heartbeat' => 'int',
        'total_orders' => 'int',
        'total_abs' => 'float',
        'total_online_paid' => 'int',
    ];

    protected $dates = [
        'date_create',
        'date_update',
        'last_login',
        'bulk_password_till',
    ];

    protected $hidden = [
        'password',
        'bulk_password',
    ];

    protected $fillable = [
        'address',
        'admin',
        'alt_tel',
        'bulk_password',
        'bulk_password_till',
        'city',
        'company',
        'contact',
        'coord',
        'country',
        'date_create',
        'date_update',
        'deleted',
        'domain',
        'email',
        'external_id',
        'heartbeat',
        'https',
        'id',
        'inv_address',
        'inv_bic',
        'inv_bic_inc',
        'inv_bic2',
        'inv_city',
        'inv_cocnr',
        'inv_company',
        'inv_contact',
        'inv_country',
        'inv_email',
        'inv_iban',
        'inv_iban_inc',
        'inv_same',
        'inv_state',
        'inv_tel',
        'inv_vatnr',
        'inv_zipcode',
        'last_ip',
        'last_login',
        'last_ua',
        'login',
        'login_type',
        'mandate_id',
        'msg_read',
        'pincode',
        'reseller_id',
        'state',
        'status',
        'subdomain',
        'tel',
        'title_counter',
        'total_abs',
        'total_online_paid',
        'total_orders',
        'website',
        'zipcode',
        'password',
    ];

    public function rules($newClientData)
    {
        return [
            'address' => 'nullable',
            'admin' => 'nullable',
            'alt_tel' => 'nullable',
            'bulk_password' => 'nullable',
            'password' => 'required',
            'bulk_password_till' => 'nullable',
            'city' => 'nullable',
            'company' => 'nullable',
            'contact' => 'nullable',
            'coord' => 'nullable',
            'country' => 'nullable',
            'date_create' => 'nullable',
            'date_update' => 'nullable',
            'deleted' => 'nullable',
            'domain' => 'nullable|unique:clients,domain',
            'email' => 'nullable|unique:clients,email',
            'external_id' => 'nullable',
            'heartbeat' => 'nullable',
            'https' => 'nullable',
            'id' => 'nullable',
            'inv_address' => 'nullable',
            'inv_bic' => 'nullable',
            'inv_bic_inc' => 'nullable',
            'inv_bic2' => 'nullable',
            'inv_city' => 'nullable',
            'inv_cocnr' => 'nullable',
            'inv_company' => 'nullable',
            'inv_contact' => 'nullable',
            'inv_country' => ['required', new NonDutchAccountWithBic($newClientData->inv_vatnr)],
            'inv_email' => 'nullable',
            'inv_iban' => ['required', new NonDutchBank($newClientData->inv_bic)],
            'inv_iban_inc' => ['required', new NonDutchBank($newClientData->inv_bic)],
            'inv_same' => 'nullable',
            'inv_state' => 'nullable',
            'inv_tel' => 'nullable',
            'inv_vatnr' => 'nullable',
            'inv_zipcode' => 'nullable',
            'last_ip' => 'nullable',
            'last_login' => 'nullable',
            'last_ua' => 'nullable',
            'login' => 'required|unique:clients,login',
            'login_type' => 'nullable',
            'mandate_id' => 'nullable',
            'msg_read' => 'nullable',
            'pincode' => 'nullable',
            'reseller_id' => 'nullable',
            'state' => 'nullable',
            'status' => 'nullable',
            'subdomain' => 'nullable|unique:clients,subdomain',
            'tel' => 'nullable',
            'title_counter' => 'nullable',
            'total_abs' => 'nullable',
            'total_online_paid' => 'nullable',
            'total_orders' => 'nullable',
            'website' => 'nullable',
            'zipcode' => 'nullable',
        ];
    }

    public function clientErrorMessages($newClientData)
    {
        return [
            'subdomain.unique' => 'Er bestaat al een klant met de subdomeinnaam '.$newClientData->subdomain,
            'domain.unique' => 'Er bestaat al een klant met de domeinnaam '.$newClientData->domain,
            'login.unique' => 'Er bestaat al een klant met de loginnaam '.$newClientData->login,
            'email.unique' => 'Er bestaat al een klant met de email '.$newClientData->email,
            'login.required' => 'Loginnaam verplicht.',
            'inv_iban.required' => 'IBAN verplicht.',
            'inv_iban_inc.required' => 'IBAN Invoice verplicht.',
            'password.required' => 'Wachtwoord verplicht',
        ];
    }

    public function resellerTodo(): HasMany 
    {
        return $this->hasMany(ResellerTodo::class);
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo('Admin\Models\Reseller');
    }

    public function printers(): HasMany
    {
        return $this->hasMany(Printer::class);
    }

    public function settings(): HasMany
    {
        return $this->hasMany('Admin\Models\ClientSetting');
    }

    public function open_hours(): HasMany
    {
        return $this->hasMany(ClientOpen::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany('Admin\Models\Invoice');
    }

    public function invoiceLines(): HasManyThrough
    {
        return $this->hasManyThrough(InvoiceLine::class, Invoice::class);
    }

    public function deliverers(): HasMany
    {
        return $this->hasMany(Deliverer::class);
    }

    public function orderStats(): HasMany
    {
        return $this->setConnection('mysql_stats')->hasMany(OrderStats::class);
    }

    public function scopeGetClientList($query)
    {
        return $query->where('deleted', 0);
    }

    public function scopeWhereCompanyLike($query, $companyName)
    {
        return $query->where('company', 'like', '%' . $companyName . '%');
    }

    public function scopeLive($query)
    {
        return $query->where('deleted', 0)->where('status', 'live');
    }

    public function scopeWhereCompanyNameLike($query, $filterParameters)
    {
        if ($filterParameters->has('company')) {
            $query->where('company', 'like', '%'.$filterParameters->company.'%');
        }
    }

    public function checkIfClientIsAdminDebit($clientId): bool
    {
        $client = $this->where('id', $clientId)
            ->with('settings', function ($query) {
                $query->where('setting', 'admin_directdebit');
            })->first();

        if ($client->settings->isEmpty()) {
            return false;
        }
        return true;
    }

    public function saveSettings($clientSettings)
    {
        if ($clientSettings) {
            foreach ($clientSettings as $key => $val) {
                if ($val !== null) {
                    (new ClientSetting())->updateOrCreate(
                        [
                            'client_id' => $this->id,
                            'setting' => $key,
                        ],
                        [
                            'client_id' => $this->id,
                            'setting' => $key,
                            'value' => $val,
                        ]
                    );
                }
            }
        }
        
        return $this;
    }

    public function checkForDomainUpdate($domainUpdated)
    {
        if ($domainUpdated && $this->domain !== $domainUpdated) {
            //Todo
//            updateDomains();  //Double check how are the domains going to be
            $this->saveSettings(['check_domain' => 1]);
        }
        return $this;
    }

    public function checkForMandateIdUpdate($differentInvoiceIban)
    {
        if ($differentInvoiceIban) {
            $mandateIdOrderInt = intval(substr($this->mandate_id, -1));
            $this->update(['mandate_id' => substr($this->mandate_id, 0, -1) . strval($mandateIdOrderInt)]);
        }
        return $this;
    }

    public function checkForPasswordUpdate($passwordUpdated)
    {
        if ($passwordUpdated) {
            $password = generatePassword($passwordUpdated);
            $this->update(['password' => $password]);

            (new ClientRemember())->where('client_id', $this->id)->delete();
        }
        return $this;
    }

    /**
     * @throws AdyenException
     */
    public function checkForAdyenUpdate($adyenUpdate)
    {
        if ($adyenUpdate) {
            (new Adyen())->updateAdyenAccountHolder($adyenUpdate['storeDetails'], $this->id, 'test');
        }
        return $this;
    }

    public function checkForSplashStatus($clientStatus)
    {
        if ($clientStatus === 'splash') {
            (new ClientZipcode())->where('client_id', $this->id)->destroy();
        }
        return $this;
    }

    public function createClientUser()
    {
        (new User())->create([
            'name' => $this->login,
            'email' => $this->email,
            'password' => $this->password,
            'client_id' => $this->id,
            'deliverer_id' => 0,
            'reseller_id' => $this->reseller_id,
        ]);

        return $this;
    }

    public function getStreetAndHouseNumber()
    {
        if (preg_match('/(.+?)\s?([\d]+[\D]*)$/i', $this->address, $result)) {
            return [
                'street' => $result[1],
                'house_number' => $result[2],
            ];
        }
        return [
            'street' => '',
            'house_number' => '',
        ];
    }

}
