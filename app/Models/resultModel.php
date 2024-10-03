<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class resultModel extends Model
{
    use HasFactory;
    protected $table = 'results';
    protected $fillable = ['student_id','result'];
    public function getstudent()
    {
        return $this->belongsTo(studentModel::class,'id');
    }
}
