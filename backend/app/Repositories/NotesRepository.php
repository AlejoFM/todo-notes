<?php

namespace App\Repositories;

use App\Models\Notes;
use InvalidArgumentException;

class NotesRepository{

    /**
     * @var Notes
     */
    protected $notes;


    /**
     * @param Notes $notes
     */

    public function __construct(Notes $notes)
    {
        $this->notes = $notes;
    }

    public function getAllNotes(){
        return $this->notes->get();
    }
    public function save($data){
        $notes = new $this->notes;
        $notes->title = $data['title'];
        $notes->content = $data['content'];
        $notes->category_id = $data['category_id'];

        $notes->save();
        return $notes->fresh();
    }

    public function editNote($data){

        $notes = Notes::find($data['notes']);

        if (!$notes) {
            throw new InvalidArgumentException('Note not found');
        }

        $notes->title = $data['title'];
        $notes->content = $data['content'];
        $notes->category_id = $data['category_id'];

        $notes->update();
        return $notes->fresh();
    }
    public function deleteNote($data){
        $notes = Notes::find($data['notes']);

        if (!$notes) {
            throw new InvalidArgumentException('Note not found');
        }

        $notes->delete();
        return $notes->fresh();
    }
    public function archiveNote($note){
        $notes = Notes::find($note);

        if (!$notes) {
            throw new InvalidArgumentException('Note not found');
        }
        $notes->archived = true;
        $notes->save();

        return $notes->fresh();
    }
    public function unArchiveNote($note){
        $notes = Notes::find($note);

        if (!$notes) {
            throw new InvalidArgumentException('Note not found');
        }
        $notes->archived = false;
        $notes->save();

        return $notes->fresh();
    }
    public function listActiveNotes(){
        $notes = Notes::where("archived", 0)->get();
        return $notes;
    }
    public function listUnActiveNote(){
        $notes = Notes::where("archived", 1)->get();
        return $notes;
    }
}

?>
