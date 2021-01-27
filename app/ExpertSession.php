<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpertSession extends Model
{
    use SoftDeletes;

    protected $table = 'expert_sessions';
    public $fillable = ['title']; //Для статичного метода create
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function questions()
    {
        return $this->hasMany('App\ExpertSessionQuestion');
    }

    public function links()
    {
        return $this->hasMany('App\ExpertSessionLink');
    }

    public function close()
    { //Закрываем сессию от ответов
        $this->is_open = false;
        $this->save();
    }
}