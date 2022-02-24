<?php

namespace App\Services\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Services\IPAddress\Models\IpAddress;

class User extends Authenticatable implements Auditable
{
    use HasFactory, Notifiable, HasApiTokens, Loggable,  \OwenIt\Auditing\Auditable;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userIpAddresses()
    {
        return $this->hasMany(IpAddress::class);
    }

    public function userAudits()
    {
        return $this->hasMany(\OwenIt\Auditing\Auditable::class);
    }

    public function userAuditTrails()
    {
        $id = $this->id;
        return $this->with('audits')->where('id', $id)->paginate(10);
    }
}
