<x-app-layout>
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col">
          <h2 class="font-semibold text-xl text-cool-gray-800 leading-tight">{{ $title }}</h2>
          <div class="flex text-sm mt-2 text-gray-600 leading-tight">
            <a href="{{ route('location.index') }}" class="text-blue-500 hover:underline">Lokasi</a>
            <span class="px-1">/</span>
            <p>{{ $title }}</p>
          </div>
      </div>
    </div>
  </header>

  <div class="py-9">
    <livewire:location.form :editId="$editId ?? null"/>
  </div>

  @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
  @endpush

  @push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>

    <script>
      function getCurrentPosition() {
        if (navigator.geolocation) {
            let position = navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            alert("Geolocation is not supported by this browser.");
        }
      }

      function showPosition(position) {
        var latlong = position.coords.latitude + "," + position.coords.longitude;
        Livewire.emit('setLatLong', latlong)
      }

      $('#getPosition').on('click', getCurrentPosition);
    </script>
  @endpush
</x-app-layout>