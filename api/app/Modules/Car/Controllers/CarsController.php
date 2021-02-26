<?php


namespace App\Modules\Car\Controllers;


use App\Core\Http\Controllers\ApiController;

use App\Domains\Cars\Entities\Car;
use App\Infrastructure\Repositories\Modules\Cars\BrandsRepository;
use App\Infrastructure\Repositories\Modules\Cars\CarsRepository;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Validator;


class CarsController extends ApiController
{

    private $itemsByPage = 5;

    private $_carsRepository;

    public function __construct(CarsRepository $carsRepository)
    {
        $this->_carsRepository = $carsRepository;
    }


    public function getIndex(Request $request)
    {

        try {


            $filter = $request->input('filter');

            $data =
                [
                    'cars' => $this->_carsRepository->getListWithFilterPaginate($this->itemsByPage, $filter)
                ];

        } catch (\Exception $e) {
            return $this->responseError($e->getMessage());
        }

        return $this->responseSuccess('', $data);
    }

    public function getListPaginate(Request $request)
    {

        try {

            $filter = $request->input('filter');

            $this->itemsByPage = $request->per_page;

            $data =
                [
                    'cars' => $this->_carsRepository->getListWithFilterPaginate($this->itemsByPage, $filter)
                ];

        } catch (\Exception $e) {

        }
        return $this->responseSuccess('', $data);
    }

    public function getWidgets(Request $request)
    {

        try {

            $filter = $request->input('filter');

            $data =
                [
                    'widgets' => $this->_carsRepository->getWidgets()
                ];

        } catch (\Exception $e) {

        }
        return $this->responseSuccess('', $data);
    }

    public function getCar(Car $id)
    {
        try {

            $data =
                [
                    'car' => $id
                ];

        } catch (\Exception $e) {

        }
        return $this->responseSuccess('', $data);
    }


    public function putEditCar(Request $request, $id)
    {
        try {

            $data = $request->only('brand_id', 'model', 'color', 'year_of_manufacture', 'engine', 'id');

            $validator = Validator::make($data, [
                'brand_id' => 'required',
                'model' => 'required',
                'year_of_manufacture' => 'required',
            ]);

            unset($data['created_at']);
            unset($data['updated_at']);

            if ($validator->fails()) {
                throw new \Exception('Os campos necessários para edição não foram informados corretamente!');
            }

            $Car = $this->_carsRepository->find($id);

            if (!$Car) throw new \Exception('O carro não foi encontrado na base de dados. Favor informar um Índice válido.');

            if (!$Car = $this->_carsRepository->update($data, $id))
                throw new \Exception('Não foi possível atualizar o Carro! Mas não se preocupe, tente novamente.');

            $data = [
                'car' => $this->_carsRepository->find($id)
            ];

        } catch (\Exception $e) {
            return $this->responseError($e->getMessage());
        }
        return $this->responseSuccess('Carro alterado com sucesso!', $data);
    }

    public function deleteRemoveCar($id)
    {
        try {

            if ($Car = $this->_carsRepository->find($id)) {
                if (!$Car->delete()) {
                    throw new \Exception('Não foi possível remover o Carro. Tente novamente.');
                }
            }

        } catch (\Exception $e) {
            return $this->responseError('');
        }
        return $this->responseSuccess('Carro removido com sucesso!', []);
    }

    public function postCreateCar(Request $request)
    {

        try {


            $data = $request->only(['brand_id', 'model', 'engine', 'color', 'year_of_manufacture']);

            $validator = Validator::make($data, [
                'brand_id' => 'required',
                'model' => 'required',
                'year_of_manufacture' => 'required',
            ]);

            if ($validator->fails()) {
                throw new \Exception('Os campos necessários para criação não foram informados corretamente!');
            }

            if (!$this->_carsRepository->create($data))
                throw new \Exception('Não foi possível cadastrar um novo carro. Mas não se preocupe! Tente novamente.');


        } catch (\Exception $e) {
            return $this->responseError($e->getMessage());
        }
        return $this->responseSuccess('Carro cadastrado com sucesso!', []);
    }
}
