<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string name
 * @property string surname
 * @property string fullName
 * @property Address address
 * @property PhoneNumber phone
 * @property Email email
 */
class Contact extends Model
{
    /**
     * @var string
     */
    protected $table = 'contacts';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return HasMany
     */
    public function emails(): HasMany
    {
        return $this->hasMany(Email::class, 'contact_id');
    }

    /**
     * @return HasOne
     */
    public function email(): HasOne
    {
        return $this->HasOne(Email::class, 'contact_id')->where('primary', 1);
    }

    /**
     * @return HasMany
     */
    public function phoneNumbers(): HasMany
    {
        return $this->hasMany(PhoneNumber::class, 'contact_id');
    }

    /**
     * @return HasOne
     */
    public function phoneNumber(): HasOne
    {
        return $this->hasOne(PhoneNumber::class, 'contact_id')->where('primary', 1);
    }

    /**
     * @return HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'contact_id');
    }

    /**
     * @return HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class, 'contact_id')->where('primary', 1);
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->surname;
    }
}
