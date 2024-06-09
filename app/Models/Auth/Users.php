<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $guarded    = ['id'];
    public $incrementing  = true;
}
