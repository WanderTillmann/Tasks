<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name','cost','description','client_id'];

    /*
        metodo da relacao
    */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    // Metodo de relacao n to n

    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }
}
