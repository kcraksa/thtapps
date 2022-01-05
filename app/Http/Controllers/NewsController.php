<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Tags;
use App\Models\Topics;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_news_status = $request->search_news_status;        
        $search_topic = $request->search_topic;        

        $filters = [
            ['news.status', 'LIKE', '%'.$search_news_status.'%'], 
            ['news.topics_id', 'LIKE', '%'.$search_topic.'%']
        ];

        $data['news'] = News::where($filters)->paginate(10);
        $data['topics'] = Topics::all();
        $data['search_param'] = $request->all();
        $data['status'] = ['' => 'All News Status', 'draft' => 'Draft', 'publish' => 'Publish', 'deleted' => 'Deleted'];
        return view('news/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['topics'] = Topics::all();
        return view('news/form_add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news = News::create([
            'topics_id' => $request->topics_id,
            'title' => $request->title,
            'content' => $request->content,
            'status' => 'draft'
        ]);

        $news_id = $news->id;
        foreach ($request->tags as $tag) {
            Tags::create([
                'news_id' => $news_id,
                'tag' => $tag
            ]);
        }

        if ($news) {
            return redirect()->route('news.index')->with('success', 'Data Saved Successfully!');
        } else {
            return redirect()->route('news.index')->with('failed', 'Failed to save data!');
        }      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['news'] = News::findOrFail($id);
        $data['topics'] = Topics::all();
        $data['tags'] = Tags::where('news_id', $id)->get();
        return view('news.form_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'topic_id' => $request->topic_id
        ]);

        if ($news) {
            $tags = Tags::where('news_id', $id)->delete();

            foreach ($request->tags as $tag) {
                Tags::create([
                    'news_id' => $id,
                    'tag' => $tag
                ]);
            }

            return redirect()->route('news.index')->with('success', 'Data Saved Successfully!');
        } else {

            return redirect()->route('news.index')->with('failed', 'Failed to save data!');
        }
    }

    public function publish(Request $request, $id)
    {
        $news = News::findOrFail($id)->update([
            'status' => 'publish'
        ]);

        if ($news) {
            return redirect()->route('news.index')->with('success', 'News has been published!');
        } else {
            return redirect()->route('news.index')->with('failed', 'Failed to publish news!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id)->delete();

        if ($news) {
            return redirect()->route('news.index')->with('success', 'Data has been deleted!');
        } else {
            return redirect()->route('news.index')->with('failed', 'Delete data failed!');
        }
    }
}
