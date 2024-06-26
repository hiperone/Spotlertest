<?php

namespace App\Http\Controllers;

use App\Http\Requests\Accounts\StoreAccountRequest;
use App\Http\Requests\Accounts\UpdateAccountRequest;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index()
    {
        return Inertia::render('Accounts/Index', [
            'accounts' => Account::all()
        ]);
    }

    public function show(Account $account)
    {
        if (!$account) {
            abort(404);
        }

        $account->load('owner');
        $account->load('contacts');

        return Inertia::render('Accounts/Show', ['account' => $account]);
    }

    public function create()
    {
        return Inertia::render('Accounts/Create', [
            'users' => User::select('id', 'name')->get()
        ]);
    }

    public function store(StoreAccountRequest $request)
    {
        $account = new Account($request->all());
        $account->save();
        return Redirect::route('accounts.index');
    }

    public function edit(Account $account)
    {
        return Inertia::render('Accounts/Edit', [
            'users' => User::select('id', 'name')->get(),
            'account' => $account
        ]);
    }

    public function update(UpdateAccountRequest $request, Account $account)
    {
        $account->update([
            'owner_id' => $request->get('owner_id') ?? $account->owner_id,
            'name' => $request->get('name') ?? $account->name,
            'address' => $request->get('address') ?? $account->address,
            'town_city' => $request->get('town_city') ?? $account->town_city,
            'country' => $request->get('country') ?? $account->country,
            'post_code' => $request->get('post_code') ?? $account->post_code,
            'phone' => $request->get('phone') ?? $account->phone
        ]);

        return Redirect::route('accounts.show', $account);
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return Redirect::route('accounts.index');
    }
}
