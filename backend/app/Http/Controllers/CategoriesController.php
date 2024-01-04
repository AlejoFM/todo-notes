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
            $result['data'] = $this->categoriesService->saveCategoriesData($data);
        }catch (Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }

        return response()->json($result, $result['status']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category)
    {
        $result = ['status' => 200, 'data' => "Deleted successfully"];

        try {
            $this->categoriesService->deleteCategories($category);
        }catch (\Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }
        return response()->json($result, $result['status']);
    }

    public function addCategory($note_id, Request $request){
        $data = ['note_data' => $note_id, 'category_data' => $request->only('category_id')];
        $result = ['status' => 200, 'data' => "Category added successfully"];

        try {
            return response()->json($this->categoriesService->addCategories($data));
        }catch (\Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }
        return response()->json($result, $result['status']);
    }
    public function removeCategory($note_id, Request $request){
        $data = ['note_data' => $note_id, 'category_data' => $request->only('category_id')];
        $result = ['status' => 200, 'data' => "Category added successfully"];

        try {
            return response()->json($this->categoriesService->addCategories($data));
        }catch (\Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }
        return response()->json($result, $result['status']);
    }
}
