<?php

namespace App\Services\IPAddress\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'label',
        'ip_address'
    ];

    public function ipAddressId(): int
    {
        return $this->id;
    }
}
