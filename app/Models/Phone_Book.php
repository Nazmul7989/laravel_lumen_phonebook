<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone_Book extends Model
{
    protected $table = 'phone__books';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestams = true;

    protected $fillable = ['name','email','phone1','phone2','address'];
}
