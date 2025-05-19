@extends('customer.layouts.app')

@section('content')
<div class="flex flex-col gap-20">
    <x-search />

    <div class="mt-6">
        <x-hotels />
    </div>
    <x-promotion />
    <x-introduce />
    <x-list-room />
    <x-step />
    <x-new />
</div>

@endsection