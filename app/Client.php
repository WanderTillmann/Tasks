<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name','email','age','photo','user_id'];

    /*
    metodo da relacao
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
