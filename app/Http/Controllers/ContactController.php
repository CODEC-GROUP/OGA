<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactCollection;
use App\Models\Contact;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

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
}
