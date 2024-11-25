<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        return Note::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'body' => 'required|string',
            'classification' => 'required|in:personal,trabajo,escuela',
        ]);

        $note = Note::create($request->all());
        return response()->json($note, 201);
    }

    public function show(string $id)
    {
        return Note::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $note = Note::findOrFail($id);
        $note->update($request->all());
        return response()->json($note, 200);
    }

    public function destroy(string $id)
    {
        Note::destroy($id);
        return response()->json(null, 204);
    }
}
