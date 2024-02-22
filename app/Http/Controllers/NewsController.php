<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\NewsCollection;
use App\Models\EmailsNews;
use App\Notifications\StayInformedAboutOgaActivities;
use Illuminate\Support\Facades\Notification;

class NewsController extends Controller
{
    /**
     * Get a paginated list of news.
     *
     * @param Request $request
     * @return EmailsCollection
     */
    public function index(Request $request)
    {
        $subject = QueryBuilder::for(News::class)
            ->allowedFilters('title', 'description')
            ->defaultSort('-created_at')
            ->allowedSorts(['created_at'])
            ->paginate();

        return new NewsCollection($subject);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        $messages = News::create($request->validated());
        $emails = [];
        $visitors = EmailsNews::select('email')->get();
        foreach ($visitors as $visitor) {
            array_push($emails, $visitor->email);
        }

        Notification::route('mail', $emails)->notify(new StayInformedAboutOgaActivities($messages));

        // dd($emails);

        return new NewsResource($messages);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $news)
    {
        News::find($news)->delete();

        return response()->noContent();
    }
}
