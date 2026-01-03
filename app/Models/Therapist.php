<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Therapist extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that not are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['password', 'photo_path'];

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
        $therapist = $this->where('email', $this->email)->first();
        $this->notify(new PasswordReset($token, $this->email, 'therapist', $therapist));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $therapist = $this->where('email', $this->email)->first();
        $verifyUrl = route('therapist.verification.verify', [
            'id' => $this->getKey(),
            'hash' => sha1($this->getEmailForVerification()),
        ]);
        $this->notify(new VerifyEmail($verifyUrl, $therapist));
    }

    /**
     * services
     *
     * @return void
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'therapist_services', 'therapist_id', 'service_id')->withPivot([
            'id', 'rate', 'status'
        ]);
    }

    /**
     * province
     *
     * @return void
     */
    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'province_id')->withDefault();
    }

    /**
     * regency
     *
     * @return void
     */
    public function regency()
    {
        return $this->hasOne(Regency::class, 'id', 'regency_id')->withDefault();
    }

    /**
     * district
     *
     * @return void
     */
    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id')->withDefault();
    }

    /**
     * referrer
     *
     * @return void
     */
    public function referrer()
    {
        return $this->hasOne(Referrer::class, 'therapist_id', 'id')->withDefault();
    }

    /**
     * areas
     *
     * @return void
     */
    public function therapistAreas()
    {
        return $this->hasMany(TherapistArea::class, 'therapist_id', 'id');
    }

    /**
     * Relasi one to many dengan order
     *
     * @return void
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'therapist_id', 'id');
    }

    /**
     * getStatusTherapistCount
     *
     * @return void
     */
    public function getStatusTherapistCount()
    {
        return $this->where('status', 'Menunggu')->count();
    }

    /**
     * Mengambil alamat lengkap
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return $this->address . ', ' . $this->village . ', Kecamatan ' . getDistrictName($this->district_id) . ', ' . getRegencyName($this->regency_id) . ', Provinsi ' . getProvinceName($this->province_id);
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
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = ltrim($value, "0");
    }

    /**
     * Menghapus 0 di depan attribute whatsapp_number
     *
     * @param  mixed $value
     * @return void
     */
    public function setWhatsappAttribute($value)
    {
        $this->attributes['whatsapp'] = ltrim($value, "0");
    }
}
