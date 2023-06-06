<?php

namespace Modules\Website\Entities;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrivacyPolicyTranslation extends Model
{
    use HasFactory, SoftDeletes, HasLanguage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'privacy_policy_translations';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'language_id', 'privacy_policy_id'];

    /**
     * return the related privacy policy
     */
    public function privacypolicy()
    {
        return $this->belongsTo(PrivacyPolicy::class, 'privacy_policy_id');
    }
}
