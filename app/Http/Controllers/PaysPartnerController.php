<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaysPartnerRequest;
use App\Http\Requests\UpdatePaysPartnerRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\PaysPartner;
use Illuminate\Http\Request;
use Flash;

class PaysPartnerController extends AppBaseController
{
    /**
     * Display a listing of the PaysPartner.
     */
    public function index(Request $request)
    {
        /** @var PaysPartner $paysPartners */
        $paysPartners = PaysPartner::paginate(10);

        return view('pays_partners.index')
            ->with('paysPartners', $paysPartners);
    }


    /**
     * Show the form for creating a new PaysPartner.
     */
    public function create()
    {
        return view('pays_partners.create');
    }

    /**
     * Store a newly created PaysPartner in storage.
     */
    public function store(CreatePaysPartnerRequest $request)
    {
        $input = $request->all();

        /** @var PaysPartner $paysPartner */
        $paysPartner = PaysPartner::create($input);

        Flash::success('Pays Partner saved successfully.');

        return redirect(route('pays-partners.index'));
    }

    /**
     * Display the specified PaysPartner.
     */
    public function show($id)
    {
        /** @var PaysPartner $paysPartner */
        $paysPartner = PaysPartner::find($id);

        if (empty($paysPartner)) {
            Flash::error('Pays Partner not found');

            return redirect(route('pays-partners.index'));
        }

        return view('pays_partners.show')->with('paysPartner', $paysPartner);
    }

    /**
     * Show the form for editing the specified PaysPartner.
     */
    public function edit($id)
    {
        /** @var PaysPartner $paysPartner */
        $paysPartner = PaysPartner::find($id);

        if (empty($paysPartner)) {
            Flash::error('Pays Partner not found');

            return redirect(route('pays-partners.index'));
        }

        return view('pays_partners.edit')->with('paysPartner', $paysPartner);
    }

    /**
     * Update the specified PaysPartner in storage.
     */
    public function update($id, UpdatePaysPartnerRequest $request)
    {
        /** @var PaysPartner $paysPartner */
        $paysPartner = PaysPartner::find($id);

        if (empty($paysPartner)) {
            Flash::error('Pays Partner not found');

            return redirect(route('pays-partners.index'));
        }

        $paysPartner->fill($request->all());
        $paysPartner->save();

        Flash::success('Pays Partner updated successfully.');

        return redirect(route('pays-partners.index'));
    }

    /**
     * Remove the specified PaysPartner from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var PaysPartner $paysPartner */
        $paysPartner = PaysPartner::find($id);

        if (empty($paysPartner)) {
            Flash::error('Pays Partner not found');

            return redirect(route('pays-partners.index'));
        }

        $paysPartner->delete();

        Flash::success('Pays Partner deleted successfully.');

        return redirect(route('pays-partners.index'));
    }
}
