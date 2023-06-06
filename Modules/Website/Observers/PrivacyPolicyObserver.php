<?php

namespace Modules\Website\Observers;

use Modules\Website\Entities\PrivacyPolicy;
use App\Services\Cache\ClearCachedAttributes;

class PrivacyPolicyObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the PrivacyPolicy "updated" event.
     *
     * @param  \Modules\Website\Entites\PrivacyPolicy  $privacy_policy
     * @return void
     */
    public function updated(PrivacyPolicy $privacy_policy)
    {
        ClearCachedAttributes::clear($privacy_policy->id, ['privacy_policy_title', 'privacy_policy_description']);
    }

    /**
     * Handle the PrivacyPolicy "deleted" event.
     *
     * @param  \Modules\Website\Entites\PrivacyPolicy  $privacy_policy
     * @return void
     */
    public function deleted(PrivacyPolicy $privacy_policy)
    {
        ClearCachedAttributes::clear($privacy_policy->id, ['privacy_policy_title', 'privacy_policy_description']);
    }
}
