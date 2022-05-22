<x-layout pageIndex="0" title="Главная">
    <x-slot name="styles">
        <link href="{{ asset('css/home/home.css') }}" rel="stylesheet">
    </x-slot>

    @include('home.excursions', ['places' => $excursions])
    @include('home.places', ['places' => $places])
</x-layout>
