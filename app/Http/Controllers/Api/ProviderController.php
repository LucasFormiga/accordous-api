<?php

namespace App\Http\Controllers\Api;

use App\Events\CreatedProviderEvent;
use App\Http\Controllers\Controller;
use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProviderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $providers = Cache::remember("providers-list-{$user->id}", 30, function () use ($user) {
            return Provider::ownedBy($user->id)->get();
        });

        return $providers;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email'],
            'payment' => ['required', 'min:1']
        ]);

        $user = auth()->user();
        $provider = Provider::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'payment' => $request->payment
        ]);

        event(new CreatedProviderEvent($provider));

        return $provider;
    }

    public function show($provider)
    {
        $user = auth()->user();
        $provider = Cache::remember("provider-show-{$provider}", 30, function () use ($user, $provider) {
            return Provider::ownedBy($user->id)->find($provider);
        });

        return $provider;
    }

    public function destroy(Provider $provider)
    {
        $user = auth()->user();
        $provider = $provider->ownedBy($user->id)->delete();

        return $provider;
    }

    public function totalPayments()
    {
        $total = 0;
        $user = auth()->user();
        $providers = Cache::remember("providers-list-{$user->id}", 30, function () use ($user) {
            return Provider::ownedBy($user->id)->get();
        });

        foreach ($providers as $provider) {
            $total += $provider->payment;
        }

        return ['total' => $total];
    }
}
