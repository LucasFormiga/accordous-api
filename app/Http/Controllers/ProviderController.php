<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    public function activate(string $uuid)
    {
        $validator = Validator::make([
            'uuid' => $uuid
        ],
        [
            'uuid' => ['required', 'uuid', 'exists:providers,activation_token']
        ]);

        if ($validator->fails()) {
            return response('O token de ativação informado é inválido.', 422);
        }

        $provider = Provider::where('activation_token', $uuid)->first();

        $provider->update([
            'active' => 1
        ]);

        return response('Ativação realizada.', 200);
    }

    public function list()
    {
        if (!session('api_token')) {
            return redirect()->route('home');
        }

        return view('list-providers');
    }
}
