<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Diagnosis extends Model
{
    use HasFactory;
    protected $fillable = ['diagnosis','symptoms','date','user_id','time'];

    protected $casts = [
        'diagnosis' => 'json',
        'symptoms' => 'json',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


