<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOpportunitySecteurChildrenRequest;
use App\Http\Requests\UpdateOpportunitySecteurChildrenRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\OpportunitySecteurChildren;
use Illuminate\Http\Request;
use Flash;

class OpportunitySecteurChildrenController extends AppBaseController
{
    /**
     * Display a listing of the OpportunitySecteurChildren.
     */
    public function index(Request $request)
    {
        /** @var OpportunitySecteurChildren $opportunitySecteurChildrens */
        $opportunitySecteurChildrens = OpportunitySecteurChildren::paginate(10);

        return view('opportunity_secteur_childrens.index')
            ->with('opportunitySecteurChildrens', $opportunitySecteurChildrens);
    }


    /**
     * Show the form for creating a new OpportunitySecteurChildren.
     */
    public function create()
    {
        return view('opportunity_secteur_childrens.create');
    }

    /**
     * Store a newly created OpportunitySecteurChildren in storage.
     */
    public function store(CreateOpportunitySecteurChildrenRequest $request)
    {
        $input = $request->all();

        /** @var OpportunitySecteurChildren $opportunitySecteurChildren */
        $opportunitySecteurChildren = OpportunitySecteurChildren::create($input);

        Flash::success('Opportunity Secteur Children saved successfully.');

        return redirect(route('opportunitySecteurChildrens.index'));
    }

    /**
     * Display the specified OpportunitySecteurChildren.
     */
    public function show($id)
    {
        /** @var OpportunitySecteurChildren $opportunitySecteurChildren */
        $opportunitySecteurChildren = OpportunitySecteurChildren::find($id);

        if (empty($opportunitySecteurChildren)) {
            Flash::error('Opportunity Secteur Children not found');

            return redirect(route('opportunitySecteurChildrens.index'));
        }

        return view('opportunity_secteur_childrens.show')->with('opportunitySecteurChildren', $opportunitySecteurChildren);
    }

    /**
     * Show the form for editing the specified OpportunitySecteurChildren.
     */
    public function edit($id)
    {
        /** @var OpportunitySecteurChildren $opportunitySecteurChildren */
        $opportunitySecteurChildren = OpportunitySecteurChildren::find($id);

        if (empty($opportunitySecteurChildren)) {
            Flash::error('Opportunity Secteur Children not found');

            return redirect(route('opportunitySecteurChildrens.index'));
        }

        return view('opportunity_secteur_childrens.edit')->with('opportunitySecteurChildren', $opportunitySecteurChildren);
    }

    /**
     * Update the specified OpportunitySecteurChildren in storage.
     */
    public function update($id, UpdateOpportunitySecteurChildrenRequest $request)
    {
        /** @var OpportunitySecteurChildren $opportunitySecteurChildren */
        $opportunitySecteurChildren = OpportunitySecteurChildren::find($id);

        if (empty($opportunitySecteurChildren)) {
            Flash::error('Opportunity Secteur Children not found');

            return redirect(route('opportunitySecteurChildrens.index'));
        }

        $opportunitySecteurChildren->fill($request->all());
        $opportunitySecteurChildren->save();

        Flash::success('Opportunity Secteur Children updated successfully.');

        return redirect(route('opportunitySecteurChildrens.index'));
    }

    /**
     * Remove the specified OpportunitySecteurChildren from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var OpportunitySecteurChildren $opportunitySecteurChildren */
        $opportunitySecteurChildren = OpportunitySecteurChildren::find($id);

        if (empty($opportunitySecteurChildren)) {
            Flash::error('Opportunity Secteur Children not found');

            return redirect(route('opportunitySecteurChildrens.index'));
        }

        $opportunitySecteurChildren->delete();

        Flash::success('Opportunity Secteur Children deleted successfully.');

        return redirect(route('opportunitySecteurChildrens.index'));
    }
}
