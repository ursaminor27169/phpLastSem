<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class ExpertAnswer extends Model
{
    protected $table = 'answers';
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function ExpertSession(){
        return $this->belongsTo('App\ExpertSession');
    }

}