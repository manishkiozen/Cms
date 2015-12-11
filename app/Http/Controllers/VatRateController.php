<?php namespace App\Http\Controllers;

use App\Commands\IndexVatRatesCommand;
use App\Commands\RegisterVatRateCommand;
use App\Commands\UpdateVatRateCommand;
use App\Http\Requests;
use App\Repositories\VatRateRepository;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class VatRateController extends Controller {

    /**
	 * Display a listing of the resource.
	 *
     * @param Request $request
	 * @return Response
	 */
	public function index(Request $request)
	{
        $vat_rates = $this->dispatchFrom(IndexVatRatesCommand::class, $request);
		return view('vat-rates.index')->with('collection', $vat_rates)
            ->with('q', $request->get('q'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('vat-rates.create');
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
            $vat_rate = $this->dispatchFrom(RegisterVatRateCommand::class, $request);
            flash()->success(trans('vat-rates.registered', ['description' => $vat_rate->description]));
            return redirect()->route('vat-rate.edit', $vat_rate->id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
        catch (\Exception $e) {
            flash()->warning($e->getMessage());
            return redirect()->back()->withInput();
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
     * @param VatRateRepository $vat_rates
	 * @return Response
	 */
	public function edit($id, VatRateRepository $vat_rates)
	{
		try {
            return view('vat-rates.edit')->with('model', $vat_rates->findById($id));
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('vat-rates.not_found'));
        }
        return redirect()->route('vat-rates.index');
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
            $vat_rate = $this->dispatchFrom(UpdateVatRateCommand::class, $request);
            flash()->success(trans('vat-rates.updated', $vat_rate->description));
            return redirect()->route('vat-rate.edit', $vat_rate->id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('vat-rates.not_found'));
            return redirect()->route('vat-rate.index');
        }
        catch (\Exception $e) {
            flash()->warning($e->getMessage());
            return redirect()->back()->withInput();
        }
	}

}
