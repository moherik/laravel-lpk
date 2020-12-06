<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lokasi</h2>
            <div class="ml-auto flex flex-row gap-x-2">
                <a href="{{ route('location.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-auto">Tambah Lokasi</a>        
            </div>        
        </div>
    </x-slot>

    <div class="py-0">
        <livewire:location.show/>
    </div>
</x-app-layout>
