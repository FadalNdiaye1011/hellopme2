<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRateTariffRequest;
use App\Http\Requests\UpdateRateTariffRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\RateTariff;
use App\Models\Finance;
use Illuminate\Http\Request;
use Flash;

class RateTariffController extends AppBaseController
{
    /**
     * Display a listing of the RateTariff.
     */
    public function index(Request $request)
    {
        /** @var RateTariff $rateTariffs */
        $rateTariffs = RateTariff::paginate(10);

        return view('rate_tariffs.index')
            ->with('rateTariffs', $rateTariffs);
    }


    /**
     * Show the form for creating a new RateTariff.
     */
    public function create()
    {
        return view('rate_tariffs.create');
    }

    public function create_override($id)
    {
        /** @var Finance $finance */
        $finance = Finance::find($id);

        if (empty($finance)) {
            Flash::error('Finance not found');

            return redirect(route('finances.index'));
        }
        return view('rate_tariffs.create')->with('finance', $finance);
    }

    /**
     * Store a newly created RateTariff in storage.
     */
    public function store(CreateRateTariffRequest $request)
    {
        $input = $request->all();

        /** @var RateTariff $rateTariff */
        $rateTariff = RateTariff::create($input);

        Flash::success('Rate Tariff saved successfully.');

        return redirect(route('rate-tariffs.index'));
    }

    /**
     * Display the specified RateTariff.
     */
    public function show($id)
    {
        /** @var RateTariff $rateTariff */
        $rateTariff = RateTariff::find($id);

        if (empty($rateTariff)) {
            Flash::error('Rate Tariff not found');

            return redirect(route('rate-tariffs.index'));
        }

        return view('rate_tariffs.show')->with('rateTariff', $rateTariff);
    }

    /**
     * Show the form for editing the specified RateTariff.
     */
    public function edit($id)
    {
        /** @var RateTariff $rateTariff */
        $rateTariff = RateTariff::find($id);

        if (empty($rateTariff)) {
            Flash::error('Rate Tariff not found');

            return redirect(route('rate-tariffs.index'));
        }

        return view('rate_tariffs.edit')->with('rateTariff', $rateTariff);
    }

    /**
     * Update the specified RateTariff in storage.
     */
    public function update($id, UpdateRateTariffRequest $request)
    {
        /** @var RateTariff $rateTariff */
        $rateTariff = RateTariff::find($id);

        if (empty($rateTariff)) {
            Flash::error('Rate Tariff not found');

            return redirect(route('rate-tariffs.index'));
        }

        $rateTariff->fill($request->all());
        $rateTariff->save();

        Flash::success('Rate Tariff updated successfully.');

        return redirect(route('rate-tariffs.index'));
    }

    /**
     * Remove the specified RateTariff from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var RateTariff $rateTariff */
        $rateTariff = RateTariff::find($id);

        if (empty($rateTariff)) {
            Flash::error('Rate Tariff not found');

            return redirect(route('rate-tariffs.index'));
        }

        $rateTariff->delete();

        Flash::success('Rate Tariff deleted successfully.');

        return redirect(route('rate-tariffs.index'));
    }
}
