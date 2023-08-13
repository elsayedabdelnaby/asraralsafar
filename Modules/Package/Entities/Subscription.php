<?php

namespace Modules\Package\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['email'];
    
    protected static function newFactory()
    {
        return \Modules\Package\Database\factories\SubscriptionFactory::new();
    }
}
