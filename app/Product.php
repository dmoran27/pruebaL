<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name','price', 'details'];
    
    public static function boot(){
        parent::boot();
        Product::observe(new \App\Observers\LogObserver);
    }
    
    public function orders(){
        return $this->belongsToMany(Order::class);
    }

}
