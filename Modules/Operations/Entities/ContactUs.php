<?php

namespace Modules\Operations\Entities;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactUs extends Model
{
    use HasFactory, Userstamps;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "contact_us_messages";

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'title',
        'message',
        'answer',
        'who_reply_id',
        'status'
    ];

    /**
     * Get the user who replying on this message
     */
    public function whoReply(): BelongsTo
    {
        return $this->belongsTo(User::class, 'who_reply_id');
    }
}
