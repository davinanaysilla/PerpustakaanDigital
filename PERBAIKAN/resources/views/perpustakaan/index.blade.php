<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: url("{{ asset('img/bg-dream.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
        }

        .text-primary-custom { color: #d63384; }

        .btn-custom {
            background: linear-gradient(145deg, #ff8da1, #ff6b6b);
            border: none;
            color: white;
            font-weight: 700;
            padding: 10px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
            color: white;
        }

        .search-group {
            background: white;
            border-radius: 12px;
            padding: 5px 15px;
            border: 1px solid #eef0f3;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            transition: all 0.3s;
        }
        .search-group:focus-within {
            border-color: #ff8da1;
            box-shadow: 0 4px 15px rgba(255, 141, 161, 0.15);
        }
        .search-group input {
            border: none; outline: none; background: transparent; width: 100%; font-weight: 600; color: #555;
        }

        .loader-overlay {
            position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(255,255,255,0.8);
            border-radius: 20px;
            display: flex; justify-content: center; align-items: center;
            z-index: 50; backdrop-filter: blur(4px);
        }

        .stat-icon { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 15px; transition: all 0.3s ease; }

        .animate-text {
            background: linear-gradient(
                45deg,
                #333333 0%,
                #d63384 25%,
                #ff6b6b 50%,
                #d63384 75%,
                #333333 100%
            );
            background-size: 300% auto;
            color: #333;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textShimmer 4s linear infinite;
        }

        @keyframes textShimmer {
            to {
                background-position: 300% center;
            }
        }

        .table-hover tbody tr:hover > td {
            background-color: #fff0f5 !important;
            color: #d63384 !important;
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .row-selected > td {
            background-color: #ffe5ec !important;
            border-left: 5px solid #ff6b6b !important;
            font-weight: 600;
        }

        .dashboard-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .dashboard-card:hover {
            transform: translateY(-8px);
            background-color: #fff0f5 !important;
            border: 1px solid #ffb6c1 !important;
            box-shadow: 0 15px 30px rgba(255, 107, 107, 0.2) !important;
        }
        .dashboard-card:hover .stat-icon {
            background: linear-gradient(135deg, #ff8da1, #ff6b6b) !important;
            color: white !important;
            transform: scale(1.1) rotate(10deg);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg mt-3 mb-4">
        <div class="container glass-card py-3 px-4" style="max-width: 980px;">
            <a class="navbar-brand fw-bold fs-5 d-flex align-items-center" href="#">
                <span class="bg-white p-2 rounded-3 shadow-sm me-2 text-primary-custom">
                    <i class="bi bi-journal-album"></i>
                </span>
                <span class="animate-text fw-extra-bold">Perpustakaan Digital By Davina</span>
            </a>
            <span class="ms-auto text-muted small fw-bold d-none d-md-block text-uppercase spacing-1">
                Dashboard Admin
            </span>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="row mb-4 g-3">
                    <div class="col-md-4">
                        <div class="glass-card dashboard-card p-3 d-flex align-items-center gap-3 h-100">
                            <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                                <i class="bi bi-journal-bookmark-fill fs-4"></i>
                            </div>
                            <div>
                                <h6 class="text-muted small mb-1 fw-bold opacity-75">TOTAL KOLEKSI</h6>
                                <h3 class="fw-black mb-0 text-dark">{{ $stats['total_buku'] }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="glass-card dashboard-card p-3 d-flex align-items-center gap-3 h-100">
                            <div class="stat-icon bg-success bg-opacity-10 text-success">
                                <i class="bi bi-stars fs-4"></i>
                            </div>
                            <div>
                                <h6 class="text-muted small mb-1 fw-bold opacity-75">BUKU BARU (7 Hari)</h6>
                                <h3 class="fw-black mb-0 text-dark">{{ $stats['buku_baru'] }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="glass-card dashboard-card p-3 d-flex align-items-center gap-3 h-100">
                            <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                <i class="bi bi-building-fill fs-4"></i>
                            </div>
                            <div>
                                <h6 class="text-muted small mb-1 fw-bold opacity-75">PENERBIT</h6>
                                <h3 class="fw-black mb-0 text-dark">{{ $stats['total_penerbit'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-4 position-relative overflow-hidden">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                        <div class="text-center text-md-start">
                            <h4 class="fw-black mb-1 text-dark">Daftar Pustaka</h4>
                            <p class="text-muted mb-0 small">Manajemen data buku perpustakaan.</p>
                        </div>
                        <div class="d-flex w-100 w-md-auto gap-2">
                            <div class="search-group d-flex align-items-center flex-grow-1" style="min-width: 250px;">
                                <i class="bi bi-search text-muted me-2"></i>
                                <input type="text" id="keyword" placeholder="Cari judul, penulis, tahun...">
                            </div>
                            <button class="btn btn-custom text-nowrap" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                <i class="bi bi-plus-lg me-1"></i> Baru
                            </button>
                        </div>
                    </div>

                    <div id="loading-spinner" class="loader-overlay d-none">
                        <div class="text-center">
                            <div class="spinner-border text-primary-custom" role="status"></div>
                            <div class="mt-3 fw-bold text-muted small">Memuat data...</div>
                        </div>
                    </div>

                    <div id="data-container">
                        @include('perpustakaan.table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-card border-0">
                <div class="modal-header border-0 pb-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold"><i class="bi bi-folder-plus me-2 text-primary-custom"></i>Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="fw-bold text-muted small mb-1">JUDUL BUKU</label>
                            <input type="text" name="judul" class="form-control bg-light border-0" required>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="fw-bold text-muted small mb-1">PENULIS</label>
                                <input type="text" name="penulis" class="form-control bg-light border-0" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="fw-bold text-muted small mb-1">TAHUN</label>
                                <input type="number" name="tahun_terbit" class="form-control bg-light border-0" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold text-muted small mb-1">PENERBIT</label>
                            <input type="text" name="penerbit" class="form-control bg-light border-0" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4 pt-0">
                        <button type="submit" class="btn btn-custom w-100 rounded-3">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-card border-0">
                <div class="modal-header border-0 pb-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEdit" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-body p-4">
                        <input type="hidden" id="edit_id">
                        <div class="mb-3">
                            <label class="fw-bold text-muted small mb-1">JUDUL BUKU</label>
                            <input type="text" name="judul" id="edit_judul" class="form-control bg-light border-0" required>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="fw-bold text-muted small mb-1">PENULIS</label>
                                <input type="text" name="penulis" id="edit_penulis" class="form-control bg-light border-0" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="fw-bold text-muted small mb-1">TAHUN</label>
                                <input type="number" name="tahun_terbit" id="edit_tahun" class="form-control bg-light border-0" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold text-muted small mb-1">PENERBIT</label>
                            <input type="text" name="penerbit" id="edit_penerbit" class="form-control bg-light border-0" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4 pt-0">
                        <button type="submit" class="btn btn-custom w-100 rounded-3">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalHapus" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content glass-card border-0 text-center p-4">
                <div class="mb-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex p-3">
                        <i class="bi bi-trash3-fill text-danger fs-1"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-dark">Hapus Buku Ini?</h5>
                <p class="text-muted small">Data yang dihapus tidak bisa dikembalikan lagi.</p>
                <form id="formHapus" method="POST">
                    @csrf @method('DELETE')
                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <button type="button" class="btn btn-light border rounded-3 w-50" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger w-50 rounded-3">Ya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast align-items-center border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 12px;">
            <div class="d-flex">
                <div class="toast-body fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill text-success fs-5"></i>
                    <span id="toastMessage">Berhasil!</span>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const keywordInput = document.getElementById('keyword');
        const dataContainer = document.getElementById('data-container');
        const loadingSpinner = document.getElementById('loading-spinner');

        const toastEl = document.getElementById('liveToast');
        const toastBody = document.getElementById('toastMessage');
        const toast = new bootstrap.Toast(toastEl);

        @if(session('success'))
            toastBody.innerText = "{{ session('success') }}";
            toast.show();
        @endif

        let state = {
            page: 1,
            search: '',
            sortBy: 'created_at',
            sortDirection: 'desc'
        };
        let debounceTimer;

        function loadData() {
            loadingSpinner.classList.remove('d-none');
            const params = new URLSearchParams({
                page: state.page,
                search: state.search,
                sort_by: state.sortBy,
                sort_direction: state.sortDirection
            });

            fetch(`{{ route('books.index') }}?${params.toString()}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.text())
            .then(html => {
                dataContainer.innerHTML = html;
                attachEvents();
            })
            .catch(err => console.error(err))
            .finally(() => {
                setTimeout(() => loadingSpinner.classList.add('d-none'), 200);
            });
        }

        keywordInput.addEventListener('keyup', function() {
            clearTimeout(debounceTimer);
            state.search = this.value;
            state.page = 1;
            debounceTimer = setTimeout(() => loadData(), 500);
        });

        function attachEvents() {
            document.querySelectorAll('.pagination a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const urlParams = new URLSearchParams(this.getAttribute('href').split('?')[1]);
                    state.page = urlParams.get('page');
                    loadData();
                });
            });

            document.querySelectorAll('.sortable').forEach(header => {
                header.addEventListener('click', function() {
                    const column = this.dataset.column;
                    if (state.sortBy === column) {
                        state.sortDirection = state.sortDirection === 'asc' ? 'desc' : 'asc';
                    } else {
                        state.sortBy = column;
                        state.sortDirection = 'asc';
                    }
                    loadData();
                });
            });
        }

        attachEvents();

        document.addEventListener('click', function(e) {

            const row = e.target.closest('tbody tr');
            if (row && !e.target.closest('button') && !e.target.closest('a')) {
                const isActive = row.classList.contains('row-selected');
                document.querySelectorAll('tbody tr').forEach(r => r.classList.remove('row-selected'));
                if (!isActive) row.classList.add('row-selected');
            }

            if (e.target.closest('.btn-edit')) {
                const btn = e.target.closest('.btn-edit');
                document.getElementById('edit_judul').value = btn.dataset.judul;
                document.getElementById('edit_penulis').value = btn.dataset.penulis;
                document.getElementById('edit_penerbit').value = btn.dataset.penerbit;
                document.getElementById('edit_tahun').value = btn.dataset.tahun;
                document.getElementById('formEdit').action = `/books/${btn.dataset.id}`;
                new bootstrap.Modal(document.getElementById('modalEdit')).show();
            }

            if (e.target.closest('.btn-delete')) {
                const btn = e.target.closest('.btn-delete');
                document.getElementById('formHapus').action = btn.dataset.url;
                new bootstrap.Modal(document.getElementById('modalHapus')).show();
            }
        });
    </script>
</body>
</html>
