<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'password',
        'blocked'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $user = $this->where('email', $this->email)->first();
        $this->notify(new PasswordReset($token, $this->email, 'patient', $user));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $user = $this->where('email', $this->email)->first();
        $verifyUrl = route('patient.verification.verify', [
            'id' => $this->getKey(),
            'hash' => sha1($this->getEmailForVerification()),
        ]);
        $this->notify(new VerifyEmail($verifyUrl, $user));
    }

    /**
     * Relasi one to one dengan kabupaten
     *
     * @return void
     */
    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'province_id')->withDefault();
    }

    /**
     * Relasi one to one dengan kabupaten
     *
     * @return void
     */
    public function regency()
    {
        return $this->hasOne(Regency::class, 'id', 'regency_id')->withDefault();
    }

    /**
     * Relasi one to one dengan kecamatan
     *
     * @return void
     */
    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id')->withDefault();
    }

    /**
     * Relasi one to one dengan referrer
     *
     * @return void
     */
    public function referrer()
    {
        return $this->hasOne(Referrer::class, 'patient_id', 'id')->withDefault();
    }

    /**
     * Mengambil alamat lengkap
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return $this->address . ', ' . $this->village . ', ' . getDistrictName($this->district_id) . ', ' . getRegencyName($this->regency_id) . ', ' . getProvinceName($this->province_id);
    }

    /**
     * Set DOB date format
     *
     * @param  mixed $value
     * @return void
     */
    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = formatDate($value, 'Y-m-d');
    }

    /**
     * Menghapus 0 di depan attribute phone_number
     *
     * @param  mixed $value
     * @return void
     */
    public function setPhoneNumberAttribute($value)
    {
        $this->attributes['phone_number'] = ltrim($value, "0");
    }

    /**
     * Menghapus 0 di depan attribute whatsapp_number
     *
     * @param  mixed $value
     * @return void
     */
    public function setWhatsappNumberAttribute($value)
    {
        $this->attributes['whatsapp_number'] = ltrim($value, "0");
    }
}
