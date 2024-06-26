<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'status',
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

}
