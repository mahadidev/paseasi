<?php

namespace App\Http\Controllers;

use App\Events\OrderShipmentStatusUpdated;
use App\Http\Requests\StoreNeedHelpRequest;
use App\Http\Requests\UpdateNeedHelpRequest;
use App\Models\NeedHelp;
use Redirect;

class NeedHelpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count_requested = count(NeedHelp::where("status", "!=", "pending")->orderByDesc("id")->get());

        $count_helped = count(NeedHelp::where(["status" => "helped"])->orderByDesc("id")->get());

        $count_need_help = count(NeedHelp::where(["status" => "activs"])->orderByDesc("id")->get());

        $needHelps = NeedHelp::where(["status" => "active"])->orderByDesc("id")->paginate(5);
        return view('index', ["needHelps" => $needHelps, "count_requested" => $count_requested, "count_helped" => $count_helped, "count_need_help" => $count_need_help]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("needHelps.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNeedHelpRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile("picture")) {
            $newImageName = "slide-".$request->slider_ref_id."-".date('YmdHis').$request->file("picture")->getClientOriginalName();
            $request->file("picture")->move(public_path('images/slides/'), $newImageName);
            $validatedData["picture"] = env("APP_URL") .'/images/slides/'. $newImageName;
        }

        NeedHelp::create($validatedData);

        if($validatedData["status"] == "active"){
            OrderShipmentStatusUpdated::dispatch();
        }

        return Redirect::route("need-help.index")->with("success", "Request has been submitted.");
    }

    /**
     * Display the specified resource.
     */
    public function show(NeedHelp $needHelp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NeedHelp $needHelp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNeedHelpRequest $request, NeedHelp $needHelp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NeedHelp $needHelp)
    {
        //
    }
}
