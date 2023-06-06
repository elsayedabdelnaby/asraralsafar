<?php

namespace Modules\Website\Actions\PrivacyPolicies;

use Modules\Website\Entities\PrivacyPolicy;
use Modules\Website\Entities\PrivacyPolicyTranslation;
use Modules\Website\Http\Requests\PrivacyPolicies\UpdatePrivacyPolicyRequest;

/**
 * handle update a privacy policy
 */
class UpdatePrivacyPolicyAction
{
    public function handle(UpdatePrivacyPolicyRequest $request, PrivacyPolicy $privacy_policy): PrivacyPolicy
    {
        $privacy_policy->display_order = $request->display_order;
        $privacy_policy->is_active = $request->is_active ? true : false;
        $privacy_policy->save();

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            PrivacyPolicyTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'privacy_policy_id' => $privacy_policy->id
                ],
                [
                    'title' => $translation['title'],
                    'description' => $translation['description']
                ]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff($privacy_policy->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            PrivacyPolicyTranslation::where([
                ['language_id', '=', $language_id],
                ['privacy_policy_id', '=', $privacy_policy->id]
            ])->delete();
        }

        return $privacy_policy;
    }
}
