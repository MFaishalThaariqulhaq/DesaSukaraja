@extends('public.layout')

@section('title', 'Struktur Organisasi dan Tata Kerja')

@push('styles')
<style>
    .tree-wrapper {
        overflow-x: auto;
        cursor: grab;
        padding: 20px;
    }

    .tree-wrapper.active {
        cursor: grabbing;
    }

    .tree {
        display: inline-flex;
        gap: 60px;
        align-items: flex-start;
        white-space: nowrap;
    }

    .node {
        text-align: center;
        min-width: 180px;
    }

    .node img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 9999px;
        border: 3px solid #e5e7eb;
        margin-bottom: 10px;
    }

    .node .name {
        font-weight: 600;
        font-size: 16px;
    }

    .node .role {
        font-size: 14px;
        color: #6b7280;
    }

    .children {
        margin-top: 40px;
        display: flex;
        gap: 40px;
        justify-content: center;
    }
</style>
@endpush

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
document.addEventListener('DOMContentLoaded', function () {

    /* ===============================
       DATA (AMAN 100%)
    =============================== */
    const staffData = @json($staffData);

    /* ===============================
       MODAL
    =============================== */
    const modal = document.getElementById('modal');
    const closeModal = document.getElementById('closeModal');

    document.querySelectorAll('.node').forEach(node => {
        node.addEventListener('click', () => {
            const id = node.dataset.id;
            if (!staffData[id]) return;

            document.getElementById('modalName').innerText = staffData[id].name;
            document.getElementById('modalRole').innerText = staffData[id].role;
            document.getElementById('modalTupoksi').innerText = staffData[id].tupoksi;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    modal.addEventListener('click', e => {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });

    /* ===============================
       DRAG SCROLL (AMAN)
    =============================== */
    const treeContainer = document.getElementById('tree-container');

    if (treeContainer) {
        let isDown = false;
        let startX;
        let scrollLeft;

        treeContainer.addEventListener('mousedown', e => {
            isDown = true;
            treeContainer.classList.add('active');
            startX = e.pageX - treeContainer.offsetLeft;
            scrollLeft = treeContainer.scrollLeft;
        });

        treeContainer.addEventListener('mouseleave', () => {
            isDown = false;
            treeContainer.classList.remove('active');
        });

        treeContainer.addEventListener('mouseup', () => {
            isDown = false;
            treeContainer.classList.remove('active');
        });

        treeContainer.addEventListener('mousemove', e => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - treeContainer.offsetLeft;
            const walk = (x - startX) * 2;
            treeContainer.scrollLeft = scrollLeft - walk;
        });
    }

});
</script>
@endpush
