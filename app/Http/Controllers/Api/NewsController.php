<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Cache;
use Validator;
use App\Http\Resources\News as NewsResource;
use App\Models\News;
use App\Models\Tags;
use App\Models\Topics;

class NewsController extends BaseController
{

    public function index(Request $request)
    {
        $search_news_status = $request->search_news_status;        
        $search_topic = $request->search_topic;        

        $filters = [
            ['news.status', 'LIKE', '%'.$search_news_status.'%'], 
            ['news.topics_id', 'LIKE', '%'.$search_topic.'%']
        ];

        $news = Cache::remember("news_all_".$search_news_status."_".$search_topic, 10 * 60, function () use ($filters)
        {
            return News::where($filters)->get();
        }); 
        return $this->sendResponse(NewsResource::collection($news), 'Get data Fectched!');
    }

    public function store(Request $request)
    {
        $news = News::create([
            'topics_id' => $request->topics_id,
            'title' => $request->title,
            'content' => $request->content,
            'status' => 'draft'
        ]);

        $news_id = $news->id;
        if (isset($request->tags)) {
            foreach ($request->tags as $tag) {
                Tags::create([
                    'news_id' => $news_id,
                    'tag' => $tag
                ]);
            }
        }
        if ($news) {

            $redis = Cache::forget("*news*");

            $dataInserted = News::where('id', $news_id)->get();
            return $this->sendResponse(NewsResource::collection($dataInserted), 'Data Saved Successfully!');
        } else {
            return $this->sendError('Failed to store data.', '', 404);
        }      
    }

    public function show($id)
    {
        $news = Cache::remember("news_all_show_{$id}", 10 * 60, function () use ($id)
        {
            return News::where('id', $id)->get();
        }); 
        return $this->sendResponse(NewsResource::collection($news), 'Get data Fectched!');
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $news->update($request->all());

        if ($news) {

            if (isset($request->tags)) {
                $tags = Tags::where('news_id', $id)->delete();
                foreach ($request->tags as $tag) {
                    Tags::create([
                        'news_id' => $id,
                        'tag' => $tag
                    ]);
                }
            }

            $redis = Cache::flush();

            $data = News::where('id', $id)->get();
            return $this->sendResponse(NewsResource::collection($data), 'Data Updated Successfully!');
        } else {
            return $this->sendError('Failed to update data.', '', 404);
        }
    }

    public function publish(Request $request, $id)
    {
        $news = News::findOrFail($id)->update([
            'status' => 'publish'
        ]);

        if ($news) {

            $redis = Cache::flush();

            $data = News::where('id', $id)->get();
            return $this->sendResponse(NewsResource::collection($data), 'News has been published!');
        } else {
            return $this->sendError('Failed to publish news!', '', 404);
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
        $news = News::findOrFail($id)->update([
            'status' => 'deleted'
        ]);

        if ($news) {

            $redis = Cache::flush();
            
            $data = News::where('id', $id)->get();
            return $this->sendResponse(NewsResource::collection($data), 'News has been deleted!');
        } else {
            return $this->sendError('Failed to delete news!', '', 404);
        }
    }
}
