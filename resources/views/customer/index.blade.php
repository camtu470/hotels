@extends('customer.layouts.app')

@section('content')
<div class="flex flex-col gap-4">
    <x-search />
    <x-hotels />
    <x-introduce />
    <x-list-room />
    <x-step />
    <x-new />
</div>

@endsection