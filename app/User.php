<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;

class User extends Authenticatable implements MustVerifyEmail, BannableContract
{
    use Notifiable, HasApiTokens;
	use SoftDeletes;
	use Bannable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password','bio','photo','type', 'email_verified_at', 'manually_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getMailPdfCount(){
        $user=User::find(auth()->user()->id);
        return $user->pdf_count;
    }

	public function hasBeenManuallyVerified()
    {
        return ! is_null($this->manually_verified_at);
    }
	
	//Public function setPasswordAttribute($password) {
	//	return $this->attributes['password'] = bcrypt($password); 
	//	}
}
