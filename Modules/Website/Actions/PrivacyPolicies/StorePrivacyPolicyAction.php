<?php

namespace Modules\Website\Actions\PrivacyPolicies;

use Modules\Website\Entities\PrivacyPolicy;
use Modules\Website\Entities\PrivacyPolicyTranslation;
use Modules\Website\Http\Requests\PrivacyPolicies\StorePrivacyPolicyRequest;

/**
 * handle create a privacy policy
 */
class StorePrivacyPolicyAction
{
    public function handle(StorePrivacyPolicyRequest $request): PrivacyPolicy
    {
        $privacy_policy = new PrivacyPolicy();
        $privacy_policy->is_active = $request->is_active ? true : false;
        $privacy_policy->display_order = $request->display_order ? $request->display_order : 0;
        $privacy_policy->save();
        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'title' => $translation['title'],
                'description' => $translation['description'],
                'language_id' => $translation['language_id'],
                'privacy_policy_id' => $privacy_policy->id,
            ];

            PrivacyPolicyTranslation::create($translation_data);
        }

        return $privacy_policy;
    }
}
