<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadRequest;
use App\Http\Requests\LeadUpdateRequest;
use App\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() :JsonResponse
    {
        $leads = Lead::paginate(10);

        return response()->json($leads, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\LeadRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LeadRequest $request) :JsonResponse
    {
        $lead = Lead::create($request->validated());

        return response()->json($lead, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Lead $lead) :JsonResponse
    {
        return response()->json($lead);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\LeadUpdateRequest  $request
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(LeadUpdateRequest $request, Lead $lead) :JsonResponse
    {
        $leadUpdated = $lead->update($request->validated());

        if($leadUpdated){
            $updatedLead = Lead::find($lead->id);
            return response()->json($updatedLead);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Lead $lead) :JsonResponse
    {
       if($lead->delete()){
           return response()->json([
               'success' => true,
           ], 204);
       }
       return response()->json([
           'success' => false,
       ]);

    }

    /**
     * Endpoint for user to opt out of marketting e-mails
     *
     * @param Lead $lead
     * @return JsonResponse
     */
    public function optOut(Lead $lead) :JsonResponse
    {
        if($lead->optOut()){
            return response()->json([
                'success' => true,
            ]);
        }
        return response()->json([
            'success' => false,
        ]);
    }
}
