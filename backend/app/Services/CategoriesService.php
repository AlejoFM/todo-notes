<?php

namespace App\Services;

use App\Repositories\CategoriesRepository;
use App\Models\Notes;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class CategoriesService{

    /**
     * @var CategoriesRepository
     */
    protected $categoriesRepository;

    /**
     * @param CategoriesRepository $categoriesRepository
     */
    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }
    public function saveCategoriesData($data){
        $validator = Validator::make($data, [
            'name' => 'required',
        ]);

        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $result = $this->categoriesRepository->save($data);
        return $result;
    }
    public function deleteCategories($category){
        $result = $this->categoriesRepository->deleteCategory($category);
        return $result;
    }

    public function addCategories($data){
        $result = $this->categoriesRepository->addCategory($data);
        return $result;
    }
    public function removeCategories($data){
        $result = $this->categoriesRepository->removeCategory($data);
        return $result;
    }
}

?>
