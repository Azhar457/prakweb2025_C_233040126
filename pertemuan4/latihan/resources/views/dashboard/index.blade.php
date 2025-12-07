<x-dashboard-layout>
    <x-slot:title>
        Dashboard
    </x-slot:title>
    <x-slot:header>Dashboard</x-slot:header>
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome, {{ auth()->user()->name }}</h1>
    @include('components.table')
</x-dashboard-layout>