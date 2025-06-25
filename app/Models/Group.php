<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class Group extends Model
{
    use HasFactory;
    protected $fillable =[
        'group_name',
        'tags',
        'description',
        'amount_people',
    ];
    protected static function booted(){
        static::creating(function ($group){
            $group->uuid = Str::uuid();
            $group->user_id = Auth::id();
            
        });
    }
    public function users() :BelongsToMany{
        return $this->belongsToMany(User::class,"groups_user", 'group_id', 'user_id');
    }
}
