<?php

namespace Modules\Website\Actions\PrivacyPolicies;

use Modules\Website\Entities\PrivacyPolicy;
use Modules\Website\Entities\PrivacyPolicyTranslation;
use Modules\Website\Http\Requests\PrivacyPolicies\DeletePrivacyPolicyRequest;

/**
 * handle delete a privacy policy
 */
class DeletePrivacyPolicyAction
{
    public function handle(DeletePrivacyPolicyRequest $request): bool
    {
        // delete translations of this privacy policy
        PrivacyPolicyTranslation::where('privacy_policy_id', $request->id)->delete();
        // delete privacy policy
        $privacy_policy = PrivacyPolicy::findOrFail($request->id);

        return $privacy_policy->delete();
    }
}
