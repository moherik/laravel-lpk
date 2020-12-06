<div>
    <div class="bg-cool-gray-200 text-cool-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-row mb-8 text-sm">
            <a href="{{ route('location.index') }}" class="border-solid border-b-2 {{ $type == null ? 'border-blue-500' : 'border-cool-gray-200' }} hover:border-blue-500 py-2 px-4">Semua Tipe</a>
            @foreach($this->location_types as $loc_type)
                <a href="?type={{ Str::slug($loc_type->title) }}" class="border-solid border-b-2 {{ Str::slug($loc_type->title) == $type ? 'border-blue-500' : 'border-cool-gray-200' }} hover:border-blue-500 py-2 px-4">{{ $loc_type->title }}</a>
            @endforeach
        </div>
    </div>

    @if(count($this->locations) > 0)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 md:grid md:grid-cols-3 md:gap-8">
            @foreach($this->locations as $location)
            <div class="bg-white text-gray-800 overflow-hidden shadow-sm py-4 px-5 sm:rounded-lg sm:mb-2">
                <div class="mb-3">
                    <p class="text-2xl font-bold mt-1 mb-3 leading-tight">{{ $location->title }}</p>
                    <p class="leading-normal text-sm">
                        <span class="font-bold">Alamat: </span>{{ $location->address }}
                    </p>
                </div>

                <div class="text-sm mb-3 leading-normal">
                    <p><span class="font-bold">Maps:</span> Buka di <a class="hover:underline" href="https://maps.google.com/?q={{ $location->lat_long }}" target="_blank">Google Maps</a></p>
                    <p><span class="font-bold">Nomor Telepon:</span> {{ $location->phone ?? '-' }}</p>
                    @if(isset($location->website) && $location->website != null)
                        <p><span class="font-bold">Website:</span> <a class="text-blue-500 hover:underline" href="//{{ $location->website }}">{{ $location->website }}</a></p>
                    @endif
                    <p><span class="font-bold">Dibuat oleh:</span> {{ $location->user->name ?? '-' }}</p>

                    <div class="flex text-xs gap-x-1 mt-1">
                        @if(isset($location->type->title))
                            <span class="rounded-full bg-cool-gray-300 px-2 py-1">{{ $location->type->title ?? '-' }}</span>
                        @endif
                        <span class="rounded-full {{ $location->is_verif <= 0 ? 'bg-red-500' : 'bg-gray-700' }} text-white px-3 py-1">{{ $location->is_verif ? 'Terverifikasi' : 'Belum diverivikasi' }}</span>
                    </div>
                </div>

                <div class="text-xs mt-4">
                    <div>
                        <a href="{{ route('location.edit', $location->id) }}" class="hover:underline">Ubah</a>
                        <span class="mx-1">&bullet;</span>
                        <a href="#" wire:click.prevent="changeVerif({{ $location->id }}, {{ $location->is_verif <= 0 ? 1 : 0 }})" class="hover:underline">{{ $location->is_verif <= 0 ? 'Verifikasi' : 'Batalkan Verifikasi' }}</a>
                        <span class="mx-1">&bullet;</span>
                        @if($requestDeleteId == $location->id)
                            <a href="#" wire:click.prevent="destroy({{$location->id}})" class="text-red-700 hover:underline font-bold">Konfirmasi Hapus?</a>
                        @else
                            <a href="#" wire:click.prevent="confirmDelete({{$location->id}})" class="text-red-500 hover:underline">Hapus</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <p class="block text-center text-sm">Tidak ada data nich.</p>
    @endif

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
        {{ $this->locations->links() }}
    </div>
</div>