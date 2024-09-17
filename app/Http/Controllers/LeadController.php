<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lead;

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
}