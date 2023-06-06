<?php

namespace Modules\Website\Actions\PrivacyPolicies;

use Modules\Website\Entities\PrivacyPolicy;
use Modules\Website\Http\Requests\PrivacyPolicies\TogglePrivacyPolicyRequest;

/**
 * @purpose toggle the privacy policy status
 */
class TogglePrivacyPolicyAction
{
    /**
     * @param TogglePrivacyPolicyRequest $request
     */
    public function handle(TogglePrivacyPolicyRequest $request): bool
    {
        $privacy_policy = PrivacyPolicy::find($request->id);
        $privacy_policy->is_active = !$privacy_policy->is_active;
        return $privacy_policy->save();
    }
}
