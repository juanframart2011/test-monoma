<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lead;
use App\Http\Requests\CreateLeadRequest;

class LeadController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $leads = Cache::remember('leads_user_' . $user->id, 60, function () use ($user) {
            return $user->isManager() ? Lead::all() : Lead::where('owner', $user->id)->get();
        });

        return response()->json(['meta' => ['success' => true, 'errors' => []], 'data' => $leads]);
    }

    public function store(CreateLeadRequest $request)
    {
        // Como el CreateLeadRequest ya valida los datos,
        // puedes estar seguro de que los datos son correctos aquí.

        $lead = Lead::create([
            'name' => $request->name,
            'source' => $request->source,
            'owner' => $request->owner,
            'created_by' => auth()->id(),  // El usuario autenticado que crea el lead
        ]);

        return response()->json([
            'meta' => [
                'success' => true,
                'errors' => []
            ],
            'data' => $lead
        ], 201);
    }
}