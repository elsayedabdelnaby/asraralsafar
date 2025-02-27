<select class="form-control language-select select2" name="language_id" required
        data-parsley-required-message="{{ __('dashboard.language_is_required') }}">
    <option value="">
        {{ __('dashboard.select_language') }}
    </option>
    @foreach (getAllLanguages() as $language)
        <option value="{{ $language->id }}" @selected($language->id == $selectedOption)>
            {{ $language->name }}
        </option>
        </option>
    @endforeach
</select>

