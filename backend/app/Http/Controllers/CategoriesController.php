<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Http\Controllers\Controller;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * @var CategoriesService
     */
    protected $categoriesService;

    /**
     * @param CategoriesService $categoriesService
     */
    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Categories::all(); // Fix it so it's layered.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['name']);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->categoriesService->saveNotesData($data);
        }catch (Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories)
    {
        //
    }
}
