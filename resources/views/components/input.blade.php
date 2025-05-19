<div class="flex flex-col gap-2 text-sm text-[#a9141e] font-bold">
    @if($label)
    <label for="{{ $name }}" class="">
        {{ $label }}
        @if($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}" @if($required)
        required @endif placeholder="{{ $placeholder }}" class="form-control p-2">
    @error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>