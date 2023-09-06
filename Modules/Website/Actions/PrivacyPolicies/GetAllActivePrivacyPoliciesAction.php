<?php

namespace Modules\Website\Actions\PrivacyPolicies;

use Illuminate\Support\Facades\DB;
use Modules\Website\Entities\PrivacyPolicy;

/**
 * handle get all active privacy policies
 */
class GetAllActivePrivacyPoliciesAction
{
    public function handle()
    {
        $privacy_policies = PrivacyPolicy::currentLanguageTranslation('privacy_policies', 'privacy_policy_translations', 'privacy_policy_id')
            ->select(
                'privacy_policies.id',
                'privacy_policy_translations.title',
                'privacy_policy_translations.description',
                'privacy_policies.display_order',
                'privacy_policies.is_active',
                DB::raw('null as Actions')
            )->active();
        return $privacy_policies->get();
    }
}
