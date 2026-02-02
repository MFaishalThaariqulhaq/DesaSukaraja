@extends('public.layout')

@section('title', 'Struktur Organisasi dan Tata Kerja')

@section('content')
<div class="container mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold text-center mb-10">
        Struktur Organisasi dan Tata Kerja
    </h1>

    <div id="tree-container" class="tree-wrapper">
        <div class="tree">

            {{-- KEPALA DESA --}}
            @if ($kepalaDesa)
                <div class="node" data-id="{{ $kepalaDesa->id }}">
                    <img src="{{ $kepalaDesa->foto ? asset('storage/'.$kepalaDesa->foto) : 'https://placehold.co/120x120/94a3b8/ffffff?text=Foto' }}">
                    <div class="name">{{ $kepalaDesa->nama }}</div>
                    <div class="role">{{ $kepalaDesa->jabatan }}</div>

                    {{-- SEKDES --}}
                    @if ($sekdes)
                        <div class="children">
                            <div class="node" data-id="{{ $sekdes->id }}">
                                <img src="{{ $sekdes->foto ? asset('storage/'.$sekdes->foto) : 'https://placehold.co/120x120/94a3b8/ffffff?text=Foto' }}">
                                <div class="name">{{ $sekdes->nama }}</div>
                                <div class="role">{{ $sekdes->jabatan }}</div>

                                {{-- KAUR & KASI --}}
                                @if ($level3->count())
                                    <div class="children">
                                        @foreach ($level3 as $s)
                                            <div class="node" data-id="{{ $s->id }}">
                                                <img src="{{ $s->foto ? asset('storage/'.$s->foto) : 'https://placehold.co/120x120/94a3b8/ffffff?text=Foto' }}">
                                                <div class="name">{{ $s->nama }}</div>
                                                <div class="role">{{ $s->jabatan }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endif

                </div>
            @endif

        </div>
    </div>
</div>

{{-- MODAL --}}
<div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg max-w-lg w-full p-6 relative">
        <button id="closeModal" class="absolute top-3 right-3 text-gray-500">✕</button>
        <h2 id="modalName" class="text-xl font-bold mb-1"></h2>
        <p id="modalRole" class="text-sm text-gray-600 mb-4"></p>
        <p id="modalTupoksi" class="text-sm leading-relaxed"></p>
    </div>
</div>
@endsection

@push('scripts')
<script>
  // Pass staffData to window object
  window.staffData = @json($staffData);
</script>
@endpush
