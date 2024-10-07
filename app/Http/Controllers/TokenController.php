<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTokenRequest;
use App\Http\Requests\UpdateTokenRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Token;
use Illuminate\Http\Request;
use Flash;

class TokenController extends AppBaseController
{
    /**
     * Display a listing of the Token.
     */
    public function index(Request $request)
    {
        /** @var Token $tokens */
        $tokens = Token::paginate(10);

        return view('tokens.index')
            ->with('tokens', $tokens);
    }


    /**
     * Show the form for creating a new Token.
     */
    public function create()
    {
        return view('tokens.create');
    }

    /**
     * Store a newly created Token in storage.
     */
    public function store(CreateTokenRequest $request)
    {
        $input = $request->all();

        /** @var Token $token */
        $token = Token::create($input);

        Flash::success('Token saved successfully.');

        return redirect(route('tokens.index'));
    }

    /**
     * Display the specified Token.
     */
    public function show($id)
    {
        /** @var Token $token */
        $token = Token::find($id);

        if (empty($token)) {
            Flash::error('Token not found');

            return redirect(route('tokens.index'));
        }

        return view('tokens.show')->with('token', $token);
    }

    /**
     * Show the form for editing the specified Token.
     */
    public function edit($id)
    {
        /** @var Token $token */
        $token = Token::find($id);

        if (empty($token)) {
            Flash::error('Token not found');

            return redirect(route('tokens.index'));
        }

        return view('tokens.edit')->with('token', $token);
    }

    /**
     * Update the specified Token in storage.
     */
    public function update($id, UpdateTokenRequest $request)
    {
        /** @var Token $token */
        $token = Token::find($id);

        if (empty($token)) {
            Flash::error('Token not found');

            return redirect(route('tokens.index'));
        }

        $token->fill($request->all());
        $token->save();

        Flash::success('Token updated successfully.');

        return redirect(route('tokens.index'));
    }

    /**
     * Remove the specified Token from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Token $token */
        $token = Token::find($id);

        if (empty($token)) {
            Flash::error('Token not found');

            return redirect(route('tokens.index'));
        }

        $token->delete();

        Flash::success('Token deleted successfully.');

        return redirect(route('tokens.index'));
    }
}
