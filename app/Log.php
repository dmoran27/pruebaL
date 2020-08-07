<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['action','action_model','action_id'];

}
