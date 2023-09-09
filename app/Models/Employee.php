<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['user_id','lname', 'fname', 'addressline','zipcode','phone','img_path'];
    public function users() {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
