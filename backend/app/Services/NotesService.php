<?php

namespace App\Services;

use App\Repositories\NotesRepository;
use App\Models\Notes;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class NotesService{

    /**
     * @var NotesRepository
     */
    protected $notesRepository;

    /**
     * @param NotesRepository $notesRepository
     */
    public function __construct(NotesRepository $notesRepository)
    {
        $this->notesRepository = $notesRepository;
    }

    public function getAll(){
        return $this->notesRepository->getAllNotes();
    }

    public function saveNotesData($data){
        $validator = Validator::make($data, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $result = $this->notesRepository->save($data);
        return $result;
    }
    public function editNotes($data){
        $validator = Validator::make($data, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $result = $this->notesRepository->editNote($data);
        return $result;

    }
    public function deleteNotes($data){
        $validator = Validator::make($data, [
            'notes' => 'required',
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $result = $this->notesRepository->deleteNote($data);
        return $result;
    }
    public function archiveNotes($note){

        $result = $this->notesRepository->archiveNote($note);
        return $result;
    }
    public function unArchiveNotes($note){
        $result = $this->notesRepository->unArchiveNote($note);
        return $result;
    }

    public function listActiveNote(){
        return  $this->notesRepository->listActiveNotes();
    }
    public function listUnActiveNote(){
        return  $this->notesRepository->listUnActiveNote();
    }
}

?>
