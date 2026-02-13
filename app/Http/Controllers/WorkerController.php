<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{

    public function index()
    {
        $workers = Worker::orderBy('created_at', 'desc')->get();
        return view('home', compact('workers'));
    }

    public function store(StoreWorkerRequest $request)
    {
        try {
            $data = $request->validated();

            Worker::create($data);

            return redirect()->route('workers.index')
                ->with('success', 'Trabajador registrado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al registrar el trabajador: ' . $e->getMessage());
        }
    }


    public function show(Worker $worker)
    {
        $detalle = $worker->detalle_calculo;
        return response()->json([
            'worker' => $worker,
            'detalle' => $detalle,
        ]);
    }


    public function update(UpdateWorkerRequest $request, Worker $worker)
    {
        try {
            $data = $request->validated();

            $worker->update($data);

            return redirect()->route('workers.index')
                ->with('success', 'Trabajador actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar el trabajador: ' . $e->getMessage());
        }
    }

    public function destroy(Worker $worker)
    {
        try {
            $worker->delete();

            return redirect()->route('workers.index')
                ->with('success', 'Trabajador eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el trabajador: ' . $e->getMessage());
        }
    }
}
