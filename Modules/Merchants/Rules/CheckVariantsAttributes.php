<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Modules\Merchants\Entities\ProductAttribute;

class CheckVariantsAttributes implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @return void
     **/
    public function __invoke($attribute, $value, $fail)
    {
        //Check Attribute Is Exist And valid
        foreach ($value as $attribute){

            $checkAttribute = ProductAttribute::where('product_attributes.id',$attribute['product_attribute'])
                ->where('product_attributes.is_active',1)
                ->where('product_attributes.input_type',$attribute['attribute_type_selected']);


            if ($attribute['attribute_type_selected'] == "select"){
                $checkAttribute = $checkAttribute->join('product_attribute_options','product_attribute_options.product_attribute_id','product_attributes.id')
                ->where('product_attribute_options.id',$attribute['product_attribute_option'])
                ->where('product_attribute_options.is_active',1);
            }

            if ($checkAttribute->count() === 0){
                $fail(__('merchants::dashboard.the_attribute_is_not_suitable_to_confirm_this_action'));
            }
        }
    }
}
