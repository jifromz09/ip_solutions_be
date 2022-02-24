<?php

namespace App\Services\IPAddress\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Services\User\Models\User;


class IpAddress extends Model implements Auditable
{
    use HasFactory,  \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'label',
        'ip_address',
        'user_id',
        'id'
    ];

    public function ipAddressId(): int
    {
        return $this->id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ipAudits()
    {
        return $this->hasMany(\OwenIt\Auditing\Auditable::class);
    }


    public function ipAuditTrails($id)
    {
        return $this->with('audits')->where('id', $id)->paginate(10);
    }
 
}
