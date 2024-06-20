<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User;

class Attachment extends Model
{
    use HasFactory;
    protected $table      = 'user_attachment';
    protected $primaryKey = 'id';
    protected $guarded    = ['id'];
    public $incrementing  = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
}
