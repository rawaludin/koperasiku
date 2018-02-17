<?php

namespace App\Http\Controllers\Api;

use App\LoanRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoanRequestResource;
use App\Http\Requests\StoreLoanRequest;

class LoanRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ambil semua loan request untuk user yang login. paginasi 3 item per halaman
        $loanRequests = auth()->user()->loanRequests()->paginate(3);

        // response API berupa collection
        return LoanRequestResource::collection($loanRequests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoanRequest $request)
    {
        $this->authorize('create', LoanRequest::class);
        // mengambil data json payload
        $payload = $request->only('amount', 'duration', 'is_submitted') + ['member_id' => auth()->user()->id];
        // membuat record di db
        $loanRequest = LoanRequest::create($payload);

        // response API berupa item
        return new LoanRequestResource($loanRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function show(LoanRequest $loanRequest)
    {
        // check policy loan request untuk user ini
        $this->authorize('view', $loanRequest);

        // tampilkan response API berupa item.
        return new LoanRequestResource($loanRequest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(LoanRequest $loanRequest)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLoanRequest $request, LoanRequest $loanRequest)
    {
        $this->authorize('update', $loanRequest);
        // mengambil data form
        $payload = $request->only('amount', 'duration', 'is_submitted');
        // update record di db
        $loanRequest->update($payload);

        // response API berupa item
        return new LoanRequestResource($loanRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanRequest $loanRequest)
    {
        $this->authorize('delete', $loanRequest);
		$loanRequest->delete();
		return response([], 204);
    }
}
