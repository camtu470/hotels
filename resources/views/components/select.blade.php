<div class="flex flex-col gap-2 text-sm text-[#a9141e] font-bold">
    @if($label)
    <label for="{{ $name }}" class="">
        {{ $label }}
        @if($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}" @if($required) required @endif class="form-select p-2">
        @if($placeholder)
        <option value="">{{ $placeholder }}</option>
        @endif

        @foreach($options as $key => $value)
        <option value="{{ $key }}" {{ $key == $selected ? 'selected' : '' }}>
            {{ $value }}
        </option>
        @endforeach
    </select>

    @error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>