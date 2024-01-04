<?php

namespace App\Repositories;

use App\Models\Categories;
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
}

?>
