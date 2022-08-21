<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class tagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest()->get();
        return view('backend.pages.tag.index', compact('tags'));
    }
    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tags,name',
        ]);

        if (!$validator->fails()) {
            $tag = new Tag();
            $tag->name = $request->name;
            $tag->slug = str::slug($request->name);
            $tag->save();
            return response()->json(['success' => 'New Tag Added Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //show
    public function show(Request $request)
    {
        $tag = Tag::find($request->id);
        return response()->json(['tag' => $tag]);
    }

    // edit
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->fails()) {
            $tag = Tag::find($request->id);
            $tag->name = $request->name;
            $tag->slug = str::slug($request->name);
            $tag->save();
            return response()->json(['success' => ' Tag Updated Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //delete
    public function delete(Request $request)
    {
        $tag = Tag::find($request->id)->delete();
        return response()->json(['success' => ' Tag Deleted Successfully!']);
    }

    //status control
    public function status(Request $request)
    {
        $tag = Tag::find($request->id);
        if ($tag->status == 0) {
            $tag->status = '1';
            $tag->save();
            return response()->json(['success' => ' Tag Activated Successfully!']);
        } else {
            $tag->status = '0';
            $tag->save();
            return response()->json(['success' => ' Tag Deactivated Successfully!']);
        }
    }

    //search
    public function search(Request $request)
    {
        $search = $request->search;
        if (!is_null($search)) {

            $tags = Tag::where('name', 'like', '%' . $search . '%')->get();
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }

        if ($tags->count() >= 1) {

            return view('backend.pages.tag.search', compact('tags'));
        } else {
            return response()->json(['not_found' => 'No Data Found.', 'search' => $request->search]);
        }
    }

}
