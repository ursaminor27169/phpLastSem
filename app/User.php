<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $table = 'users';
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
        $this->save();
    }

    public function ExpertSessions(){
        return $this->hasMany('App\ExpertSession');
    }
}