<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class resultModel extends Model
{
    use HasFactory;
    protected $table = 'address';
    protected $fillable = ['country_name','user_id'];
    
    //   public function address(){
    //     return $this->belongsTo(User::class,'user_id','id');
    // }
}
