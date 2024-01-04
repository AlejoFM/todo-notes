<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Services\NotesService;


class NotesController extends Controller
{
    /**
     * @var NotesService
     */
    protected $notesService;

    /**
     * @param NotesService $notesService
     */
    public function __construct(NotesService $notesService)
    {
        $this->notesService = $notesService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->notesService->getAll();
        }catch (Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['title', 'content', 'categories_id']);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->notesService->saveNotesData($data);
        }catch (Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notes $notes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update($notes, Request $request)
    {
        $data = $request->only(['title', 'content', 'categories_id']);
        $data['notes'] = $notes;

        $result = ['status' => 200];

        try {
            $result['data'] = $this->notesService->editNotes($data);
        }catch (Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }
        return response()->json($result, $result['status']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($note)
    {
        $note;
        $result = ['status' => 200, 'data' => "Deleted successfully"];

        try {
            $this->notesService->deleteNotes($note);
        }catch (Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }
        return response()->json($result, $result['status']);
    }

    public function archiveNote($note){

        $result = ['status' => 200, 'data' => "note archived successfully"];

        try {
            $this->notesService->archiveNotes($note);
        }catch (Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }
        return response()->json($result, $result['status']);
    }
    public function unArchiveNote($note){
        $result = ['status' => 200, 'data' => "note unarchived successfully"];

        try {
            $this->notesService->unArchiveNotes($note);
        }catch (Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }
        return response()->json($result, $result['status']);
    }
    public function listActiveNotes(){
        $result = ['status' => 200, 'data' => "notes listed successfully", 'info' => ''];


        try {
            $notes = $this->notesService->listActiveNote();
            $result['info'] = $notes;
        }catch (Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }
        return response()->json($result, $result['status']);
    }
    public function listUnActiveNotes(){
        $result = ['status' => 200, 'data' => "notes listed successfully", 'info' => ''];

        try {
            $notes = $this->notesService->listUnActiveNote();
            $result['info'] = $notes;
        }catch (Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }
        return response()->json($result, $result['status']);
    }

    public function filterNotes($category_id){
        $result = ['status' => 200, 'data' => "notes listed successfully", 'info' => ''];

        try {
            $notes = $this->notesService->filterNotes($category_id);
            $result['info'] = $notes;
        }catch (Exception $e){
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }
        return response()->json($result, $result['status']);
    }
}
