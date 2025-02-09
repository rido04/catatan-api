<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Note::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    //  menyimpan catatan baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note = Note::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($note, 201);
    }

    //  menampilkan  notes berdasarkan ID
    public function show(Note $note)
    {
        return response()->json($note, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    // untuk update notes
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $note->update($request->only(['title', 'content']));

        return response()->json($note, 200);
    }

    // untuk delete notes
    public function destroy(Note $note)
    {
        $note->delete();

        return response()->json(null, 204);
    }
}
