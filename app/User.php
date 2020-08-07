<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'ci',
    ];

    public static function boot(){
        parent::boot();
        User::observe(new \App\Observers\LogObserver);
    }

    public function orders(){
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

}
