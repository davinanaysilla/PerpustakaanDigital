<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->search;

            $query->where(function($q) use ($search) {
                $q->where('judul', 'LIKE', "%{$search}%")
                  ->orWhere('penulis', 'LIKE', "%{$search}%")
                  ->orWhere('penerbit', 'LIKE', "%{$search}%")
                  ->orWhere('tahun_terbit', 'LIKE', "%{$search}%");
            });
        }

        $sortColumn = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        $allowedColumns = ['judul', 'penulis', 'penerbit', 'tahun_terbit', 'created_at'];
        if (in_array($sortColumn, $allowedColumns)) {
            $query->orderBy($sortColumn, $sortDirection);
        } else {
            $query->latest();
        }

        $books = $query->paginate(5);

        if ($request->ajax()) {
            return view('perpustakaan.table', compact('books'))->render();
        }

        $stats = [
            'total_buku' => Book::count(),
            'buku_baru' => Book::where('created_at', '>=', now()->subDays(7))->count(),
            'total_penerbit' => Book::distinct('penerbit')->count('penerbit'),
        ];

        return view('perpustakaan.index', compact('books', 'stats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric'
        ]);
        Book::create($validated);
        return redirect()->route('books.index')->with('success', 'Buku baru berhasil ditambahkan.');
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric'
        ]);
        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Data buku berhasil dihapus.');
    }
}
