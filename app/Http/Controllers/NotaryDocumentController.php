<?php

namespace App\Http\Controllers;

use App\Models\NotaryDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotaryDocumentController extends Controller
{
    public function index()
    {
        $documents = NotaryDocument::where('user_id', Auth::id())->get();
        return response()->json($documents);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'file' => 'required|file',
        ]);

        $path = $request->file('file')->store('notary_documents', 'public');

        $document = NotaryDocument::create([
            'user_id' => Auth::id(),
            'name' => $data['name'],
            'path' => $path,
        ]);

        return response()->json($document, 201);
    }
}