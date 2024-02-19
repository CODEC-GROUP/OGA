<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonCollection;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return PersonCollection
     */
    public function index()
    {
        $person = QueryBuilder::for(Person::class)
            ->allowedFilters('name', 'type')
            ->defaultSort('-created_at')
            ->allowedSorts(['created_at'])
            ->paginate();

        return new PersonCollection($person);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StorePersonRequest $request
     * @return PersonResource
     */
    public function store(StorePersonRequest $request): PersonResource
    {
        $validatedData = $request->validated();
        $person = Person::create($validatedData);
        return new PersonResource($person);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Person $person
     * @return PersonResource
     */
    public function show(Request $request, Person $person): PersonResource
    {
        return new PersonResource($person);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePersonRequest $request
     * @param Person $person
     * @return PersonResource
     */
    public function update(UpdatePersonRequest $request, Person $person): PersonResource
    {
        $validatedData = $request->validated();
        $person->update($validatedData);
        return new PersonResource($person);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Person $person
     * @return Response
     */
    public function destroy(Request $request, Person $person): Response
    {
        $person->delete();
        return response()->noContent();
    }
}
