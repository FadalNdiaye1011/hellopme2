<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTypeOpportunityRequest;
use App\Http\Requests\UpdateTypeOpportunityRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\TypeOpportunity;
use Illuminate\Http\Request;
use Flash;

class TypeOpportunityController extends AppBaseController
{
    /**
     * Display a listing of the TypeOpportunity.
     */
    public function index(Request $request)
    {
        /** @var TypeOpportunity $typeOpportunities */
        $typeOpportunities = TypeOpportunity::paginate(10);

        return view('type_opportunities.index')
            ->with('typeOpportunities', $typeOpportunities);
    }


    /**
     * Show the form for creating a new TypeOpportunity.
     */
    public function create()
    {
        return view('type_opportunities.create');
    }

    /**
     * Store a newly created TypeOpportunity in storage.
     */
    public function store(CreateTypeOpportunityRequest $request)
    {
        $input = $request->all();

        /** @var TypeOpportunity $typeOpportunity */
        $typeOpportunity = TypeOpportunity::create($input);

        Flash::success('Type Opportunity saved successfully.');

        return redirect(route('type-opportunities.index'));
    }

    /**
     * Display the specified TypeOpportunity.
     */
    public function show($id)
    {
        /** @var TypeOpportunity $typeOpportunity */
        $typeOpportunity = TypeOpportunity::find($id);

        if (empty($typeOpportunity)) {
            Flash::error('Type Opportunity not found');

            return redirect(route('type-opportunities.index'));
        }

        return view('type_opportunities.show')->with('typeOpportunity', $typeOpportunity);
    }

    /**
     * Show the form for editing the specified TypeOpportunity.
     */
    public function edit($id)
    {
        /** @var TypeOpportunity $typeOpportunity */
        $typeOpportunity = TypeOpportunity::find($id);

        if (empty($typeOpportunity)) {
            Flash::error('Type Opportunity not found');

            return redirect(route('type-opportunities.index'));
        }

        return view('type_opportunities.edit')->with('typeOpportunity', $typeOpportunity);
    }

    /**
     * Update the specified TypeOpportunity in storage.
     */
    public function update($id, UpdateTypeOpportunityRequest $request)
    {
        /** @var TypeOpportunity $typeOpportunity */
        $typeOpportunity = TypeOpportunity::find($id);

        if (empty($typeOpportunity)) {
            Flash::error('Type Opportunity not found');

            return redirect(route('type-opportunities.index'));
        }

        $typeOpportunity->fill($request->all());
        $typeOpportunity->save();

        Flash::success('Type Opportunity updated successfully.');

        return redirect(route('type-opportunities.index'));
    }

    /**
     * Remove the specified TypeOpportunity from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var TypeOpportunity $typeOpportunity */
        $typeOpportunity = TypeOpportunity::find($id);

        if (empty($typeOpportunity)) {
            Flash::error('Type Opportunity not found');

            return redirect(route('type-opportunities.index'));
        }

        $typeOpportunity->delete();

        Flash::success('Type Opportunity deleted successfully.');

        return redirect(route('type-opportunities.index'));
    }
}
