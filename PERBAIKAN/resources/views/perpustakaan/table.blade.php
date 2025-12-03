<div class="table-responsive rounded-4">
    <table class="table table-hover align-middle mb-0">
        <thead style="background-color: rgba(255, 141, 161, 0.1);">
            <tr>
                <th class="py-3 px-4 text-secondary small fw-bold text-uppercase border-bottom-0 rounded-start-4">No</th>

                <th class="py-3 text-secondary small fw-bold text-uppercase border-bottom-0 sortable cursor-pointer" data-column="judul">
                    Judul Buku <i class="bi bi-arrow-down-up ms-1" style="font-size: 10px;"></i>
                </th>
                <th class="py-3 text-secondary small fw-bold text-uppercase border-bottom-0 sortable cursor-pointer" data-column="penulis">
                    Penulis <i class="bi bi-arrow-down-up ms-1" style="font-size: 10px;"></i>
                </th>
                <th class="py-3 text-secondary small fw-bold text-uppercase border-bottom-0 sortable cursor-pointer" data-column="penerbit">
                    Penerbit <i class="bi bi-arrow-down-up ms-1" style="font-size: 10px;"></i>
                </th>
                <th class="py-3 text-center text-secondary small fw-bold text-uppercase border-bottom-0 sortable cursor-pointer" data-column="tahun_terbit">
                    Tahun <i class="bi bi-arrow-down-up ms-1" style="font-size: 10px;"></i>
                </th>

                <th class="py-3 px-4 text-center text-secondary small fw-bold text-uppercase border-bottom-0 rounded-end-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr style="height: 10px;"><td colspan="6" class="border-0"></td></tr>

            @forelse($books as $key => $book)
            <tr class="bg-white shadow-sm hover-lift" style="transition: transform 0.2s;">
                <td class="px-4 fw-bold text-muted border-0 rounded-start-4">{{ $books->firstItem() + $key }}</td>
                <td class="border-0"><span class="fw-bold text-dark d-block">{{ $book->judul }}</span></td>
                <td class="text-secondary border-0">{{ $book->penulis }}</td>
                <td class="border-0"><span class="badge bg-light text-secondary border fw-bold px-3 py-2 rounded-pill">{{ $book->penerbit }}</span></td>
                <td class="text-center border-0"><span class="fw-bold text-dark bg-light px-2 py-1 rounded small">{{ $book->tahun_terbit }}</span></td>
                <td class="text-center border-0 rounded-end-4">
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn btn-sm btn-light text-warning border-0 shadow-sm btn-edit rounded-3"
                                style="width: 32px; height: 32px; background: #fff8e1;"
                                data-id="{{ $book->id }}"
                                data-judul="{{ $book->judul }}"
                                data-penulis="{{ $book->penulis }}"
                                data-penerbit="{{ $book->penerbit }}"
                                data-tahun="{{ $book->tahun_terbit }}"
                                data-bs-toggle="tooltip" title="Edit">
                            <i class="bi bi-pencil-fill small"></i>
                        </button>

                        <button type="button" class="btn btn-sm btn-light text-danger border-0 shadow-sm rounded-3 btn-delete"
                                style="width: 32px; height: 32px; background: #ffebee;"
                                data-url="{{ route('books.destroy', $book->id) }}"
                                data-bs-toggle="tooltip" title="Hapus">
                            <i class="bi bi-trash3-fill small"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <tr style="height: 8px;"><td colspan="6" class="border-0 bg-transparent"></td></tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5 border-0 bg-transparent">
                    <div class="text-muted opacity-50">
                        <i class="bi bi-folder-x display-3 d-block mb-3"></i>
                        <span class="fw-bold">Belum ada data buku.</span>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top border-light">
    <div class="text-muted small fw-bold">
        Hal. {{ $books->currentPage() }} / {{ $books->lastPage() }}
    </div>
    <div class="clean-pagination">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
</div>

<style>
    tbody tr.hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;
        z-index: 10;
        position: relative;
    }
    .clean-pagination .page-link {
        color: #777; border: none; background: white; margin: 0 3px; font-weight: 700; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); font-size: 0.9rem;
    }
    .clean-pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #ff8da1, #ff6b6b); color: white; box-shadow: 0 4px 10px rgba(255, 107, 107, 0.3);
    }
</style>
