<?php

namespace App\Http\Controllers;

use App\Models\EmailsNews;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\EmailsResource;
use App\Http\Resources\EmailsCollection;
use App\Http\Requests\StoreEmailsNewsRequest;

class EmailsNewsController extends Controller
{

    /**
     * Get a paginated list of email.
     *
     * @param Request $request
     * @return EmailsCollection
     */
    public function index(Request $request)
    {
        $emails = QueryBuilder::for(EmailsNews::class)
            ->allowedFilters('email')
            ->defaultSort('-created_at')
            ->allowedSorts(['created_at'])
            ->paginate();

        return new EmailsCollection($emails);
    }


    public function store(StoreEmailsNewsRequest $request)
    {
        $email = EmailsNews::create($request->validated());
        return new EmailsResource($email);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, EmailsNews $email)
    {
        $email->delete();
        return response()->noContent();
    }
}
