<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\ContactResource;

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



    /**
     * Record the informations's user in database and send email to admin's email.
     * 
     * @param ContactRequest $request
     * @return \Illuminate\Http\Response
     */

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


    /**
     * Display the specified contact.
     *
     * @param Contact $contact
     * @return ContactResource
     */
    public function show(Contact $contact)
    {
        return new ContactResource($contact);
    }




    /**
     * Remove the specified contact from storage.
     *
     * @param Request $request
     * @param Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Contact $contact)
    {
        $contact->delete();
        return response()->noContent();
    }
}
