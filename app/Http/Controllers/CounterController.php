<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManageCounterRequest;
use App\Http\Requests\StoreCounterRequest;
use App\Http\Requests\UpdateCounterRequest;
use Illuminate\Http\Request;
use App\Models\Counter;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

class CounterController extends Controller
{
    use ApiResponser;
    /**
     * Lista de elementos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->httpOkResponse(Counter::all());
    }

    /**
     * Crea un registro del recurso
     *
     * @param  App\Http\Requests\StoreCounterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCounterRequest $request)
    {
        $counter = Counter::create($request->all());
        return $this->generateResponse($counter, Response::HTTP_CREATED);
    }

    /**
     * Obtiene el recurso especificado
     *
     * @param  App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function show(Counter $counter)
    {
        return $this->httpOkResponse($counter);
    }

    /**
     * Actualiza un recurso especifico
     *
     * @param  App\Http\Requests\UpdateCounterRequest  $request
     * @param  App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCounterRequest $request, Counter $counter)
    {
        $counter->update($request->all());
        return $this->httpOkResponse($counter);
    }

    /**
     * Incrementa el valor de un contador
     *
     * @param Request $request
     * @return void
     */
    public function increment(ManageCounterRequest $request)
    {
        $counter = Counter::byData($request->data);
        if ($counter) {
            $counter->incrementAmount($request->amount);
            return $this->httpOkResponse($counter);
        }

        return $this->generateResponse(['Contador no encontrado con los datos enviados'], Response::HTTP_NOT_FOUND);
    }

    /**
     * Decrementa el valor de un contador
     *
     * @param Request $request
     * @return void
     */
    public function decrement(ManageCounterRequest $request)
    {
        $counter = Counter::byData($request->data);
        if ($counter) {
            $counter->decrementAmount($request->amount);
            return $this->httpOkResponse($counter);
        }
        return $this->generateResponse(['Contador no encontrado con los datos enviados'], Response::HTTP_NOT_FOUND);
    }

    /**
     * Elimina un recurso especifico
     *
     * @param  App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Counter $counter)
    {
        $counter->delete();
        return $this->httpOkResponse();
    }
}
