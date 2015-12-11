<?php namespace App\Http\Controllers;

use App\Commands\ChangeDefaultCarrierCommand;
use App\Commands\IndexCarriersCommand;
use App\Commands\RegisterCarrierCommand;
use App\Commands\UpdateCarrierCommand;
use App\Http\Requests;
use App\Repositories\CarrierRepository;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CarrierController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
     * @param Request $request
	 * @return Response
	 */
	public function index(Request $request)
	{
        $carriers = $this->dispatchFrom(IndexCarriersCommand::class, $request);
		return view('carriers.index')->with('collection', $carriers)
            ->with('q', $request->get('q'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('carriers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
     * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		try {
            $carrier = $this->dispatchFrom(RegisterCarrierCommand::class, $request);
            flash()->success(trans('carriers.created', ['name' => $carrier->name]));
            return redirect()->route('carrier.edit', $carrier->id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
     * @param CarrierRepository $carriers
	 * @return Response
	 */
	public function edit($id, CarrierRepository $carriers)
	{
		try {
            return view('carriers.edit')->with('model', $carriers->findById($id));
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('carriers.not_found'));
            return redirect()->route('carrier.index');
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id
     * @param Request $request
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		try {
            $request->merge(compact('id'));
            $carrier = $this->dispatchFrom(UpdateCarrierCommand::class, $request);
            flash()->success(trans('carriers.updated', ['name' => $carrier->name]));
            return redirect()->route('carrier.edit', $carrier->id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('carriers.not_found'));
            return redirect()->route('carrier.index');
        }
        catch (\Exception $e) {
            flash()->warning($e->getMessage());
            return redirect()->back()->withInput();
        }
	}

}
