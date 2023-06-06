<?php

namespace Modules\Merchants\Actions\DeliveryAdjustment;
use Modules\Merchants\Entities\DeliveryAdjustmentApplying;
use Modules\Merchants\Entities\DeliveryAdjustmentDay;
use Modules\Merchants\Entities\DeliveryAdjustments;
use Modules\Merchants\Entities\DeliveryAdjustmentTranslation;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\UpdateDeliveryAdjustmentsRequest;
use Modules\Merchants\Services\DeliveryAdjustmentsService;
class UpdateDeliveryAdjustmentsAction
{
    public function handle(UpdateDeliveryAdjustmentsRequest $request): void
    {
        $delivery_adjustments_service = new DeliveryAdjustmentsService();

        //Update Delivery Adjustments
        $delivery_adjustments = DeliveryAdjustments::find($request->get('id'));
        $delivery_adjustments->update($delivery_adjustments_service->prepareAttributes($request));

        //Update Delivery Adjustments Translations
        $this->updateDeliveryAAdjustmentsTranslations($request,$delivery_adjustments);

        //Delete All Days
        $delivery_adjustments->days()->delete();

        //Create Delivery Adjustments Days
        DeliveryAdjustmentDay::insert($delivery_adjustments_service->prepareAttributesToDays($request,$delivery_adjustments));


        //Delete All Delivery Adjustments Applying
        $delivery_adjustments->applying()->delete();

        //Create Delivery Adjustments Applying
        DeliveryAdjustmentApplying::insert($delivery_adjustments_service->prepareAttributesApplying($request, $delivery_adjustments));

    }

    /**
     * @param UpdateDeliveryAdjustmentsRequest $request
     * @param $delivery_adjustments
     * @return void
     */
    private function updateDeliveryAAdjustmentsTranslations(UpdateDeliveryAdjustmentsRequest $request, $delivery_adjustments): void
    {
        $languagesIds = [];
        foreach ($request->get('translations') as $translation) {
            $languagesIds[] = $translation['language_id'];
            DeliveryAdjustmentTranslation::updateOrCreate(
                [
                    'language_id'            => $translation['language_id'],
                    'delivery_adjustment_id' => $delivery_adjustments->id
                ],
                [
                    "name" => $translation["name"],
                    'description'=>$translation['description']
                ]
            );
        }

        $this->deleteDonotExistTranslationsInNew($delivery_adjustments->translations->pluck('language_id')->toArray(), $languagesIds, $delivery_adjustments->id);
    }

    /**
     * @param $toArray
     * @param array $languagesIds
     * @param $id
     * @return void
     */
    private function deleteDonotExistTranslationsInNew(array $currentLanguagesIds, array $newLanguagesIds, int $delivery_adjustment_id):void
    {
        $deletedLanguages = array_diff($currentLanguagesIds, $newLanguagesIds);
        DeliveryAdjustmentTranslation::whereIn('language_id', $deletedLanguages)->where('delivery_adjustment_id', $delivery_adjustment_id)->delete();
    }
}
