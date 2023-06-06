<?php

namespace Modules\UsersManagement\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * @purpose get all users with a specific type and status
 */
class GetAllMerchantManager
{
    /**
     * @param array $conditions
     */
    public function handle(int $merchant_owner_id)
    {
        return User::select('users.id', 'users.name')->where('report_id',$merchant_owner_id)->get();
    }
}
