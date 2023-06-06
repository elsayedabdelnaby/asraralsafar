<?php

namespace Modules\Website\Actions\Information;

use App\Traits\FileUploadTrait;
use Modules\Website\Entities\WebsiteInformation;
use Modules\Website\Entities\WebsiteInformationTranslation;
use Modules\Website\Http\Requests\Information\UpdateInformaitonRequest;

/**
 * handle updating the website information
 */
class UpdateInformationAction
{
    use FileUploadTrait;

    /**
     * @param UpdateInformationRequest $request
     * @param WebsiteInformation $website_information
     * @return WebsiteInformation
     */
    public function handle(UpdateInformaitonRequest $request, WebsiteInformation $website_information): WebsiteInformation
    {
        $main_logo = $website_information->main_logo ? $website_information->main_logo : '';
        if ($request->hasFile('main_logo')) {
            $file = $this->verifyAndUpload($request->file('main_logo'), $main_logo, 'public', 'website');
            $main_logo = $file;
        }

        $footer_logo = $website_information->footer_logo ? $website_information->footer_logo : '';
        if ($request->hasFile('footer_logo')) {
            $file = $this->verifyAndUpload($request->file('footer_logo'), $footer_logo, 'public', 'website');
            $footer_logo = $file;
        }

        // update translations
        $languages = [];
        foreach ($request->translations as $translation) {
            $languages[] = $translation['language_id'];
            WebsiteInformationTranslation::updateOrCreate(
                ['language_id' => $translation['language_id'], 'website_information_id' => $website_information->id],
                ['name' => $translation['name']]
            );
        }

        // delete not exists translations
        $deleted_languages = array_diff($website_information->translations->pluck('language_id')->toArray(), $languages);
        foreach ($deleted_languages as $language_id) {
            WebsiteInformationTranslation::where([
                ['language_id', '=', $language_id],
                ['website_information_id', '=', $website_information->id]
            ])->delete();
        }

        $website_information->main_logo = $main_logo;
        $website_information->footer_logo = $footer_logo;
        $website_information->facebook_pixel_code = $request->facebook_pixel_code;
        $website_information->google_analytics_code = $request->google_analytics_code;
        $website_information->save();
        return $website_information;
    }
}
