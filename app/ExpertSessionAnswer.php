<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class ExpertSessionAnswer extends Model
{
    protected $table = 'expert_session_answers';
    protected $guarded = [];
    public $fillable = ['answer_json', 'author_ip', 'expert_session_link_id'];
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function ExpertSession()
    {
        return $this->belongsTo('App\ExpertSession');
    }

}