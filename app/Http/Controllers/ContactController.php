<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\ContactCollection;

class ContactController extends Controller
{
    /**
     * Get a paginated list of contacts.
     *
     * @param Request $request
     * @return ContactCollection
     */
    public function index(Request $request)
    {
        $contacts = QueryBuilder::for(Contact::class)
            ->allowedFilters('subject', 'name')
            ->defaultSort('-created_at')
            ->allowedSorts(['created_at'])
            ->paginate();

        return new ContactCollection($contacts);
    }



    public function contact(ContactRequest $request)
    {
        Mail::send(new ContactMail($request->validated()));
        $data = $request->validated();
        $data['status'] = '0';
        Contact::create($data);
        return response()->json([
            "status_message" => "your email has been send successfully"
        ], 201);
    }
}
