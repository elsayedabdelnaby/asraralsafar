@php
    $weekDays = [
        'saturday',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday'
    ];

@endphp
<select class="form-control select2" name="{{ $name }}" id="{{ $id }}"
    @isset($isRequired)
        @if ($isRequired)
            required
            data-parsley-required-message="{{ $requiredMessage }}"
        @endif
    @endisset

    @if(isset($isMultiple)) multiple="multiple" @endif
>
    @foreach ($weekDays as $day)
        <option value="{{ $day }}"
                @if ($day ==  $selectedOption) selected @endif
                @if(is_array($selectedOption) && in_array($day,$selectedOption)) selected @endif
        >
            {{ $day }}
        </option>
    @endforeach
</select>
