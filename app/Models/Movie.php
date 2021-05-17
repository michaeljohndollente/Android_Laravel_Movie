<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'imgpath', 
        'title', 
        'description',
        'release',
        'producer_id',
        'genre_id'
    ];
    
    public $timestamps = false;

    public function producer(){
        return $this->belongsTo('App\Models\Producer', 'producer_id');
    }

    public function genre(){
        return $this->belongsTo('App\Models\Genre', 'genre_id');
    }
    
    public function roles(){
        return $this->hasMany(Role::class);
    }


}
