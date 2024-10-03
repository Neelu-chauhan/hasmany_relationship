<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentModel extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = ['id','name','email','phone'];

    public function getresult(){
        return $this->hasOne(resultModel::class,'id');  //one to one (hasone)
    }
}
