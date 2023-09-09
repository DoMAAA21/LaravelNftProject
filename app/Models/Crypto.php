<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;
    public $table = 'crypto_owned';
   // protected $guarded = ['id'];
    public $timestamps = false;
   // protected $fillable = ['name','stock','status','img_path'];
}
