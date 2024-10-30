<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function create()
    {

        //trả về dữ liệu của  lịch sử suggestion theo id của user
        $suggestions = Suggestion::where('user_id', auth()->id())->get();

        return view('suggestions.create', compact('suggestions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'suggestion_text' => 'required|string',
        ]);

        Suggestion::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'suggestion_text' => $request->suggestion_text,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Thank you for your suggestion!');
    }

    public function show($id)
    {
        $suggestion = Suggestion::findOrFail($id);
        return view('suggestions.show', compact('suggestion'));
    }
    

}
