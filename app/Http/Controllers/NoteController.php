<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    // Menampilkan semua catatan milik user yang login
    public function index(Request $request)
{
    $query = Note::where('user_id', Auth::id());

    if ($request->has('search')) {
        $search = $request->query('search');
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%$search%")
              ->orWhere('content', 'like', "%$search%");
        });
    }

    $notes = $query->paginate(5);

    // Debugging: Cek query yang dijalankan
    return response()->json([
        // 'query_debug' => $query->toSql(),
        // 'bindings' => $query->getBindings(),
        'data' => $notes
    ]);
}



    // Menyimpan catatan baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note = Note::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($note, 201);
    }


    // Menampilkan catatan berdasarkan ID
    public function show(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($note);
    }


    // Mengupdate catatan
    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $note->update($request->only(['title', 'content']));

        return response()->json($note);
    }


    // Menghapus catatan
    public function destroy(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $note->delete();

        return response()->json(['message' => 'Note deleted']);
    }
}
