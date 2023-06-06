<select class="form-control select2" name="{{ $name }}" id="{{ $id }}"
    @isset($isRequired)
        @if ($isRequired)
            required
            data-parsley-required-message="{{ $requiredMessage }}"
        @endif
    @endisset>
    <option value="">
        {{ $defaultOptionName }}
    </option>
    @foreach ($options as $option)
        <option value="{{ $option->value }}"  @if($option->name == $selectedOption) selected @endif  @selected($option->value == $selectedOption)>
            {{ __('dashboard.' . $option->name) }}
        </option>
    @endforeach
</select>
