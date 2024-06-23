<?php

namespace App\Models\Auth;

use App\Models\Menu\Record;
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
        return $this->hasMany(Attachment::class, 'userId', 'id');
    }

    public function crimes(): HasMany
    {
        return $this->hasMany(Record::class, 'userId', 'id');
    }
}
