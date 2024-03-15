<?php

namespace App\Models;

use App\Services\UserService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'phonenumber'
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


    /**
     * Receives 3 last freespins of current user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function freespins()
    {
        return $this->hasMany(Freespin::class, 'user_id')->latest()->take(3);
    }

    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->setLinkExpiredDate();
        $user->setLink();
        $user->save();

        return $user;
    }

    public function setLinkExpiredDate()
    {
        $currentDateTime = Carbon::now();
        $this->link_expires_at = $currentDateTime->addDays(7);

        $this->save();
    }

    public function setLink()
    {
        $this->link = UserService::generateFreespinLink();

        $this->save();
    }
}
