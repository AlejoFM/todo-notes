<?php

namespace App\Repositories;

use App\Models\Categories;
use App\Models\Notes;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class CategoriesRepository{

    /**
     * @var Categories
     */
    protected $categories;


    /**
     * @param Categories $categories
     */

    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }
    public function getAllCategories($data){
        return $this->categories->get();
    }
    public function save($data ){
        $categories = new $this->categories;
        $categories->name = $data['name'];

        $categories->save();
        return $categories->fresh();
    }
    public function deleteCategory($category){
        $category = Categories::find($category);

        if (!$category) {
            throw new InvalidArgumentException('Category not found');
        }
        $category->delete();
        return $category->fresh();
    }

    public function addCategory($data){
        $note_id = $data['note_data'];
        $category_id = $data['category_data'];
        $note = Notes::findOrFail($note_id);
        $note->categories()->attach($category_id);

        return $note;

    }
    public function removeCategory($data){
        $note_id = $data['note_data'];
        $category_id = $data['category_data'];
        $note = Notes::findOrFail($note_id);
        $note->categories()->detach($category_id);

        return $note;
    }
}

?>
