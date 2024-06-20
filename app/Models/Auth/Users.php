<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Users extends Model
{
    use HasFactory;
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $guarded    = ['id'];
    public $incrementing  = true;


    public function attachment(): HasMany
    {
        return $this->hasMany(Attachment::class, 'user_id', 'id');
    }
}
