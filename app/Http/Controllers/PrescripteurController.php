<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePrescripteurRequest;
use App\Http\Requests\UpdatePrescripteurRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Prescripteur;
use App\Models\Pays;
use App\Models\File;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Str;


class PrescripteurController extends AppBaseController
{
    /**
     * Display a listing of the Prescripteur.
     */
    public function index(Request $request)
    {
        /** @var Prescripteur $prescripteurs */
        $prescripteurs = Prescripteur::paginate(10);

        return view('prescripteurs.index')
            ->with('prescripteurs', $prescripteurs);
    }


    /**
     * Show the form for creating a new Prescripteur.
     */
    public function create()
    {
        $pays = Pays::all();
        return view('prescripteurs.create')
        ->with('pays', $pays);
    }

    /**
     * Store a newly created Prescripteur in storage.
     */
    public function store(CreatePrescripteurRequest $request)
    {
        $input = $request->all();

        //Logo
        if($request->hasfile('logo')):
        
            $filePath = 'prescripteurs/logos/';
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            do {
                $input['logo'] = Str::random(20). '.' . $extension;
                $file_state = File::where('id', $input['logo']);
                File::firstOrCreate(
                    [
                        'id' => $input['logo']
                    ],
                    [
                        'id' => $input['logo'],
                        'type' => $extension
                    ]
                );
            } while (empty($file_state));

            $filePath = 'prescripteurs/logos/';
            \Storage::disk('s3')->put( $filePath . $input['logo'], file_get_contents($file), 'public');  
        endif;

        /** @var Prescripteur $prescripteur */
        $prescripteur = Prescripteur::create($input);

        Flash::success('Prescripteur saved successfully.');

        return redirect(route('prescripteurs.index'));
    }

    /**
     * Display the specified Prescripteur.
     */
    public function show($id)
    {
        /** @var Prescripteur $prescripteur */
        $prescripteur = Prescripteur::find($id);

        if (empty($prescripteur)) {
            Flash::error('Prescripteur not found');

            return redirect(route('prescripteurs.index'));
        }

        return view('prescripteurs.show')->with('prescripteur', $prescripteur);
    }

    /**
     * Show the form for editing the specified Prescripteur.
     */
    public function edit($id)
    {
        /** @var Prescripteur $prescripteur */
        $prescripteur = Prescripteur::find($id);
        
        $pays = Pays::all();

        if (empty($prescripteur)) {
            Flash::error('Prescripteur not found');

            return redirect(route('prescripteurs.index'));
        }

        return view('prescripteurs.edit')
        ->with('prescripteur', $prescripteur)
        ->with('pays', $pays);

    }

    /**
     * Update the specified Prescripteur in storage.
     */
    public function update($id, UpdatePrescripteurRequest $request)
    {
        /** @var Prescripteur $prescripteur */
        $prescripteur = Prescripteur::find($id);
        $data = $request->all();

        if (empty($prescripteur)) {
            Flash::error('Prescripteur not found');

            return redirect(route('prescripteurs.index'));
        }

        //Logo
        if($request->hasfile('logo')):
        
            $filePath = 'prescripteurs/logos/';
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            do {
                $data['logo'] = Str::random(20). '.' . $extension;
                $file_state = File::where('id', $data['logo']);
                File::firstOrCreate(
                    [
                        'id' => $data['logo']
                    ],
                    [
                        'id' => $data['logo'],
                        'type' => $extension
                    ]
                );
            } while (empty($file_state));

            $filePath = 'prescripteurs/logos/';
            \Storage::disk('s3')->put( $filePath . $data['logo'], file_get_contents($file), 'public');  
        endif;

        $prescripteur->fill($data);
        $prescripteur->save();

        Flash::success('Prescripteur updated successfully.');

        return redirect(route('prescripteurs.index'));
    }

    /**
     * Remove the specified Prescripteur from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Prescripteur $prescripteur */
        $prescripteur = Prescripteur::find($id);

        if (empty($prescripteur)) {
            Flash::error('Prescripteur not found');

            return redirect(route('prescripteurs.index'));
        }

        $prescripteur->delete();

        Flash::success('Prescripteur deleted successfully.');

        return redirect(route('prescripteurs.index'));
    }
}
