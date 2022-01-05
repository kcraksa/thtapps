<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topics;

class TopicsController extends Controller
{
    public function index(Request $request)
    {
        $search_topic = $request->search_topic;

        $data['topics'] = Topics::where('topic', 'like', '%'.$search_topic.'%')->orderBy('id', 'DESC')->paginate(10);
        return view('topics/index', $data);
    }

    public function store(Request $request)
    {
        $topic = Topics::create([
            'topic' => $request->topic
        ]);

        if ($topic) {
            return back()->with('success', 'Data Saved Successfully!');
        } else {
            return back()->with('failed', 'Failed to Save Data.');
        }
    }

    public function update(Request $request, $id)
    {
        $topic = Topics::findOrFail($id);

        if ($topic->update($request->all())) {
            return back()->with('success', 'Data Saved Successfully!');
        } else {
            return back()->with('failed', 'Failed to Save Data.');
        }
    }

    public function destroy($id)
    {
        $topic = Topics::findOrFail($id)->delete();

        if ($topic) {
            return back()->with('success', 'Data Deleted Successfully!');
        } else {
            return back()->with('failed', 'Failed to Delete Data.');
        }
    }
}
