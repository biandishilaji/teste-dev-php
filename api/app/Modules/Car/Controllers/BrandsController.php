<?php


namespace App\Modules\Car\Controllers;


use App\Core\Http\Controllers\ApiController;
use App\Domains\Cars\Entities\Brand;
use App\Infrastructure\Repositories\Modules\Cars\BrandsRepository;
use App\Infrastructure\Repositories\Modules\Cars\CarsRepository;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

class BrandsController extends ApiController
{

    private $_brandsRepository;

    public function __construct(BrandsRepository $brandsRepository)
    {
        $this->_brandsRepository = $brandsRepository;
    }

    public function getBrands()
    {

        try {

            if (!$this->validExistsDefaultBrands()) {
                throw new \Exception('Não há marcas de carros pré-definidas. Favor executar o comando "php artisan db:seed" no terminal.');
            }

            $data =
                   [
                    'brands' => $this->_brandsRepository->getAllBrands()->get()
                ];

        } catch (\Exception $e) {
            return $this->responseError($e->getMessage());
        }
        return $this->responseSuccess('', $data);
    }

    public function getAllBrands(){
        try {
            $brandsRepository = new BrandsRepository(Container::getInstance());

            $data = [
                'brands' => $brandsRepository->all()
            ];

        }catch (\Exception $e){

        }
        return $this->responseSuccess('', $data);
    }

    public function postCreateBrand(Request $request){

        try {

            $name = $request->get('name');

            $brand = $this->_brandsRepository->findBy('name', $name);

            if ($brand){
             return $this->responseError('Oops! já existe uma marca cadastrada com o mesmo nome.');
            }

            $Brand = new Brand();
            $Brand->name = $name;
            $Brand->default = 0;
            $Brand->save();

            $data = [
                'brands' => $this->_brandsRepository->all()
            ];

        }catch (\Exception $e){

            return $this->responseError($e->getMessage(), []);

        }
        return $this->responseSuccess('Nova marca cadastrada com sucesso!', $data);
    }

    private function validExistsDefaultBrands()
    {
        try {

            return $this->_brandsRepository->getCountAllBrands(1) ?: false;

        } catch (\Exception $e) {
            throw $e;
        }

    }
    }
