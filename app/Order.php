<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    //
    
    use Notifiable, SoftDeletes;
    protected $fillable = ['user_id', 'total', 'tax', 'status', 'comments'];
    
    public static function boot(){
        parent::boot();
        Order::observe(new \App\Observers\LogObserver);
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
        

    }

}
