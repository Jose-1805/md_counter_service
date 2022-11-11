<?php

namespace App\Http\Controllers;

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
