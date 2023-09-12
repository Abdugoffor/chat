<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['from_id', 'to_id', 'body'];
    /**
     * Get the user that owns the Message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

     public function from()
     {
         return $this->belongsTo(User::class,'from_id');
     }
     public function to()
     {
         return $this->belongsTo(User::class,'to_id');
     }

}
