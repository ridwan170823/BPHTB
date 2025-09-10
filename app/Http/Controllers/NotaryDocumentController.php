<?php

namespace App\Http\Controllers;

use App\Models\NotaryDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotaryDocumentController extends Controller
{
   public function index(Request $request)
    {
        $documents = NotaryDocument::where('user_id', Auth::id())->get();
       if ($request->wantsJson()) {
            return response()->json($documents);
        }

        return view('notaris.documents.index', compact('documents'));
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

         if ($request->wantsJson()) {
            return response()->json($document, 201);
        }

        return redirect()->route('notaris.documents.index');
    }
}