<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAreaInterestRequest;
use App\Http\Requests\UpdateAreaInterestRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\AreaInterest;
use Illuminate\Http\Request;
use Flash;

class AreaInterestController extends AppBaseController
{
    /**
     * Display a listing of the AreaInterest.
     */
    public function index(Request $request)
    {
        /** @var AreaInterest $areaInterests */
        $areaInterests = AreaInterest::paginate(10);

        return view('area_interests.index')
            ->with('areaInterests', $areaInterests);
    }


    /**
     * Show the form for creating a new AreaInterest.
     */
    public function create()
    {
        return view('area_interests.create');
    }

    /**
     * Store a newly created AreaInterest in storage.
     */
    public function store(CreateAreaInterestRequest $request)
    {
        $input = $request->all();

        /** @var AreaInterest $areaInterest */
        $areaInterest = AreaInterest::create($input);

        Flash::success('Area Interest saved successfully.');

        return redirect(route('areaInterests.index'));
    }

    /**
     * Display the specified AreaInterest.
     */
    public function show($id)
    {
        /** @var AreaInterest $areaInterest */
        $areaInterest = AreaInterest::find($id);

        if (empty($areaInterest)) {
            Flash::error('Area Interest not found');

            return redirect(route('areaInterests.index'));
        }

        return view('area_interests.show')->with('areaInterest', $areaInterest);
    }

    /**
     * Show the form for editing the specified AreaInterest.
     */
    public function edit($id)
    {
        /** @var AreaInterest $areaInterest */
        $areaInterest = AreaInterest::find($id);

        if (empty($areaInterest)) {
            Flash::error('Area Interest not found');

            return redirect(route('areaInterests.index'));
        }

        return view('area_interests.edit')->with('areaInterest', $areaInterest);
    }

    /**
     * Update the specified AreaInterest in storage.
     */
    public function update($id, UpdateAreaInterestRequest $request)
    {
        /** @var AreaInterest $areaInterest */
        $areaInterest = AreaInterest::find($id);

        if (empty($areaInterest)) {
            Flash::error('Area Interest not found');

            return redirect(route('areaInterests.index'));
        }

        $areaInterest->fill($request->all());
        $areaInterest->save();

        Flash::success('Area Interest updated successfully.');

        return redirect(route('areaInterests.index'));
    }

    /**
     * Remove the specified AreaInterest from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var AreaInterest $areaInterest */
        $areaInterest = AreaInterest::find($id);

        if (empty($areaInterest)) {
            Flash::error('Area Interest not found');

            return redirect(route('areaInterests.index'));
        }

        $areaInterest->delete();

        Flash::success('Area Interest deleted successfully.');

        return redirect(route('areaInterests.index'));
    }
}
