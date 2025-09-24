<?php

// app/Http/Controllers/TagController.php
namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\FundType;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::with('fundTypeRelation')->get();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        $fundtypes = FundType::all();
        $journalTypes = [
            'Cash Disbursement Journal',
            'Check Disbursement Journal',
            'General Journal',
            'Debit Account Journal',
            'Cash Check Receipt Journal'
        ];
        return view('tags.create', compact('fundtypes', 'journalTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'journal_type' => 'required|string',
            'fundtype' => 'nullable|exists:fundtypes,id'
        ]);

        Tag::create([
            'description' => $request->description,
            'journal_type' => $request->journal_type,
            'fundtype' => $request->fundtype // can be null for "All"
        ]);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        $fundtypes = FundType::all();
        $journalTypes = [
            'Cash Disbursement Journal',
            'Check Disbursement Journal',
            'General Journal',
            'Debit Account Journal',
            'Cash Check Receipt Journal'
        ];
        return view('tags.edit', compact('tag', 'fundtypes', 'journalTypes'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'journal_type' => 'required|string',
            'fundtype' => 'nullable|exists:fundtypes,id'
        ]);

        $tag->update($request->all());

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}
