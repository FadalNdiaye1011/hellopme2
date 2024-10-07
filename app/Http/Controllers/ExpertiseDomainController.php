<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExpertiseDomainRequest;
use App\Http\Requests\UpdateExpertiseDomainRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\ExpertiseDomain;
use Illuminate\Http\Request;
use Flash;

class ExpertiseDomainController extends AppBaseController
{
    /**
     * Display a listing of the ExpertiseDomain.
     */
    public function index(Request $request)
    {
        /** @var ExpertiseDomain $expertiseDomains */
        $expertiseDomains = ExpertiseDomain::paginate(10);

        return view('expertise_domains.index')
            ->with('expertiseDomains', $expertiseDomains);
    }


    /**
     * Show the form for creating a new ExpertiseDomain.
     */
    public function create()
    {
        return view('expertise_domains.create');
    }

    /**
     * Store a newly created ExpertiseDomain in storage.
     */
    public function store(CreateExpertiseDomainRequest $request)
    {
        $input = $request->all();

        /** @var ExpertiseDomain $expertiseDomain */
        $expertiseDomain = ExpertiseDomain::create($input);

        Flash::success('Expertise Domain saved successfully.');

        return redirect(route('expertiseDomains.index'));
    }

    /**
     * Display the specified ExpertiseDomain.
     */
    public function show($id)
    {
        /** @var ExpertiseDomain $expertiseDomain */
        $expertiseDomain = ExpertiseDomain::find($id);

        if (empty($expertiseDomain)) {
            Flash::error('Expertise Domain not found');

            return redirect(route('expertiseDomains.index'));
        }

        return view('expertise_domains.show')->with('expertiseDomain', $expertiseDomain);
    }

    /**
     * Show the form for editing the specified ExpertiseDomain.
     */
    public function edit($id)
    {
        /** @var ExpertiseDomain $expertiseDomain */
        $expertiseDomain = ExpertiseDomain::find($id);

        if (empty($expertiseDomain)) {
            Flash::error('Expertise Domain not found');

            return redirect(route('expertiseDomains.index'));
        }

        return view('expertise_domains.edit')->with('expertiseDomain', $expertiseDomain);
    }

    /**
     * Update the specified ExpertiseDomain in storage.
     */
    public function update($id, UpdateExpertiseDomainRequest $request)
    {
        /** @var ExpertiseDomain $expertiseDomain */
        $expertiseDomain = ExpertiseDomain::find($id);

        if (empty($expertiseDomain)) {
            Flash::error('Expertise Domain not found');

            return redirect(route('expertiseDomains.index'));
        }

        $expertiseDomain->fill($request->all());
        $expertiseDomain->save();

        Flash::success('Expertise Domain updated successfully.');

        return redirect(route('expertiseDomains.index'));
    }

    /**
     * Remove the specified ExpertiseDomain from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var ExpertiseDomain $expertiseDomain */
        $expertiseDomain = ExpertiseDomain::find($id);

        if (empty($expertiseDomain)) {
            Flash::error('Expertise Domain not found');

            return redirect(route('expertiseDomains.index'));
        }

        $expertiseDomain->delete();

        Flash::success('Expertise Domain deleted successfully.');

        return redirect(route('expertiseDomains.index'));
    }
}
