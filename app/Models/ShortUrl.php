<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ShortUrl extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'company_id',
    'original_url',
    'short_code',
    'name'
];

   public function shortUrls()
{
    return $this->hasMany(ShortUrl::class);
}

 public function user()
    {
        return $this->belongsTo(User::class);
    }
}
