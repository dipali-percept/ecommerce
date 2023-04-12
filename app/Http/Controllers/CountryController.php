<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:country-list|country-create|country-edit|country-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:country-create', ['only' => ['create','store']]);
        // $this->middleware('permission:country-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:country-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::latest()->paginate(10);
        return view('country.index',compact('countries'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        Country::create($request->all());

        return redirect()->route('country.index')->with('success','Country created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return view('country.show',compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return view('country.edit',compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        request()->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        $country->update($request->all());

        return redirect()->route('country.index')->with('success','Country updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('country.index')->with('success','Country deleted successfully');
    }
}
