<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Newsletter $newsletter)
    {
        //

        $search = isset($request->search) ? $request->search : '';
        $size = isset($request->size) ? $request->size : 20;

        $newsletters = $newsletter->where('name', 'like', '%' . $search . '%')
                                    ->orWhere('email', 'like', '%' . $search . '%')
                                    ->orderBy('name')
                                    ->paginate($size);

        return $newsletters;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Newsletter $newsletter)
    {

        $addNewsletter = $newsletter->updateOrCreate([
            'email' => $request->email
        ],[
            'name' => $request->name
        ]);

        if (!$addNewsletter) {
            return success('', 'Error on subscribing email to our newsletter, please try again', 'error');

        }

        return success('', "Thanks for joining our newsletter! We can't wait to share our latest updates with you.", 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newsletter $newsletter)
    {
        //
    }
}
