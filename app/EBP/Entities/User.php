<?php

namespace App\EBP\Entities;

use App\EBP\Accessors\User\UserAccessor;
use App\EBP\Constants\UserRole;
use App\EBP\Entities\Filler\Warehouse;
use App\EBP\Entities\Notification\Notification;
use App\EBP\Entities\Quotation\Quotation;
use App\EBP\Repositories\Users\IRolesRepository;
use App\Notifications\EmailNotification;
use App\Notifications\ResetUserPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mpociot\Firebase\SyncsWithFirebase;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;
    use UserAccessor;
    use SoftDeletes, EntrustUserTrait {
        SoftDeletes::restore insteadof EntrustUserTrait;
        EntrustUserTrait::restore insteadof SoftDeletes;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * User belongs to role
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * User has one user detail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userDetail()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    /**
     * get user by role
     *
     * @param $query
     * @param $role
     * @return mixed
     */
    public function scopeGetByRole($query, $role)
    {
        return $query->whereHas('roles', function ($query) use ($role) {
            $query->where('roles.id', app(IRolesRepository::class)
                ->findByField('name', $role)->first()->id);
        });
    }

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     */
//    public function quotations()
//    {
//        return $this->hasMany(Quotation::class, 'created_by', 'id');
//    }

    /**
     * user has many notifications
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $route    = request()->segment('1') == 'administrator' ? 'password.reset' :
            'client.password.reset';
        $template = 'forgotten-password';
        $mailData = [
            'email'   => $this->email,
            'name'    => $this->name,
            'subject' => 'Reset Password mail',
            'token'   => $token,
        ];
        $this->notify(new EmailNotification($template,
            [
                'replace' => [
                    '@token'  => $mailData['token'],
                    '@action' => route($route, ['token' => $mailData['token']]),
                ],
            ]));
    }

//    /**
//     * User may has one tmp sign up
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\HasOne
//     */
//    public function tmpSignUp()
//    {
//        return $this->hasOne(TmpSignUp::class, 'user_id');
//    }
//
//    /**
//     * User has one assembly user account
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\HasOne
//     */
//    public function assemblyUser()
//    {
//        return $this->hasOne(AssemblyUser::class, 'user_id');
//    }
}
