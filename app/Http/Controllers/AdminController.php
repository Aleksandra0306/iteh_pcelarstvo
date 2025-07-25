<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aktivnost;
use App\Models\Sugestija;
use Illuminate\Http\Request;
use App\Http\Requests\AktivnostRequest;
use App\Http\Requests\SugestijaRequest;

class AdminController extends Controller
{
    public function createActivities(AktivnostRequest $request)
    {
        $users = User::where('role', 'pcelar')->get();
        $data = $request->validated();
        foreach ($users as $user) {
            $data['user_id'] = $user->id;
            Aktivnost::create($data);
        }
        return response()->json(['message' => 'Aktivnosti uspešno kreirane.']);
    }

    public function createSuggestion($id, SugestijaRequest $request)
    {
        $user = User::findOrFail($id);
       
        $data = $request->validated();
        $data['user_id'] = $user->id;
        Sugestija::create($data);
        return response()->json(['message' => 'Sugestija uspešno kreirana.']);
    }
}
