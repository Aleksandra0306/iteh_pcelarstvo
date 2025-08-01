<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Sugestija;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SugestijaRequest;
use App\Http\Resources\SugestijaResource;

class SugestijaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        //$sugestije=Sugestija::where('user_id',$user->id);
        $sugestije = Sugestija::with('user');
        if ($user->role !== 'admin') {
            $sugestije->where('user_id', $user->id);
        }

        return SugestijaResource::collection($sugestije->latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SugestijaRequest $request)
    {
        $user = Auth::user();

        $data = $request->validated();
        $data['user_id'] = $user->id;

        $sugestija = Sugestija::create($data);

        return response()->json([
            'message' => 'Sugestija uspešno kreirana',
            'model' => new SugestijaResource($sugestija)
        ]);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Sugestija $sugestija)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sugestija $sugestije)
    {
        if (Gate::allows('delete', $sugestije)) {
            $sugestije->delete();

            return response()->json([
                'message' => 'Sugestija uspešno obrisana.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Nemate dozvolu da obrišete ovu sugestiju.',
            ], 403);
        }
    }
}
