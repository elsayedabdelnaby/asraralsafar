<?php

namespace Modules\Sales\Actions\OrderStatus;

use Illuminate\Http\Request;
use Modules\Sales\Entities\OrderStatus;

class UpdateReorderOrderStatusAction
{

    /**
     * @param Request $request
     * @return void
     */
    public function handle(Request $request)
    {
        foreach ($request->all() as $orderStatusId=>$newPosition){
            OrderStatus::find($orderStatusId)->update(['display_order'=>$newPosition]);
        }
    }


}
