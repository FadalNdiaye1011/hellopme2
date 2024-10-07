<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWebsiteLinkRequest;
use App\Http\Requests\UpdateWebsiteLinkRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\PaysPartner;
use App\Models\Prescripteur;
use App\Models\TypeOpportunity;
use App\Models\WebsiteLink;
use Illuminate\Http\Request;
use Flash;

class WebsiteLinkController extends AppBaseController
{
    /**
     * Display a listing of the WebsiteLink.
     */
    public function index(Request $request)
    {
        /** @var WebsiteLink $websiteLinks */
        $websiteLinks = WebsiteLink::paginate(10);

        return view('website_links.index')
            ->with('websiteLinks', $websiteLinks);
    }


    /**
     * Show the form for creating a new WebsiteLink.
     */
    public function create()
    {
        $typeOpportunities = TypeOpportunity::all();
        $paysPartners = PaysPartner::select('pays_partners.id as pays_partner_id', 'pays.fr as pays_name')
        ->join('pays', 'pays_partners.pays_id', '=', 'pays.id')
        ->get();
        $prescripteurs = Prescripteur::all();

        return view('website_links.create', compact('typeOpportunities', 'paysPartners', 'prescripteurs'));
    }

    /**
     * Store a newly created WebsiteLink in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        /** @var WebsiteLink $websiteLink */
        $websiteLink = WebsiteLink::create($input);

        Flash::success('Website Link saved successfully.');

        return redirect(route('website-links.index'));
    }

    /**
     * Display the specified WebsiteLink.
     */
    public function show($id)
    {
        /** @var WebsiteLink $websiteLink */
        $websiteLink = WebsiteLink::find($id);

        if (empty($websiteLink)) {
            Flash::error('Website Link not found');

            return redirect(route('website-links.index'));
        }

        return view('website_links.show')->with('websiteLink', $websiteLink);
    }

    /**
     * Show the form for editing the specified WebsiteLink.
     */
    public function edit($id)
    {
        /** @var WebsiteLink $websiteLink */
        $websiteLink = WebsiteLink::find($id);

        if (empty($websiteLink)) {
            Flash::error('Website Link not found');

            return redirect(route('website-links.index'));
        }

        $typeOpportunities = TypeOpportunity::all();
        $paysPartners = PaysPartner::select('pays_partners.id as pays_partner_id', 'pays.fr as pays_name')
        ->join('pays', 'pays_partners.pays_id', '=', 'pays.id')
        ->get();
        $prescripteurs = Prescripteur::all();

        return view('website_links.edit', compact('websiteLink', 'typeOpportunities', 'paysPartners', 'prescripteurs'));
    }

    /**
     * Update the specified WebsiteLink in storage.
     */
    public function update($id, Request $request)
    {
        /** @var WebsiteLink $websiteLink */
        $websiteLink = WebsiteLink::find($id);

        if (empty($websiteLink)) {
            Flash::error('Website Link not found');

            return redirect(route('website-links.index'));
        }

        $websiteLink->fill($request->all());
        $websiteLink->save();

        Flash::success('Website Link updated successfully.');

        return redirect(route('website-links.index'));
    }

    /**
     * Remove the specified WebsiteLink from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var WebsiteLink $websiteLink */
        $websiteLink = WebsiteLink::find($id);

        if (empty($websiteLink)) {
            Flash::error('Website Link not found');

            return redirect(route('website-links.index'));
        }

        $websiteLink->delete();

        Flash::success('Website Link deleted successfully.');

        return redirect(route('website-links.index'));
    }
}
