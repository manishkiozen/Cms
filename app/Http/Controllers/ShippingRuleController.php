<?php namespace App\Http\Controllers;

use App\Commands\IndexShippingRulesCommand;
use App\Commands\RegisterShippingRuleCommand;
use App\Commands\UpdateShippingRuleCommand;
use App\Http\Requests;
use App\Repositories\CarrierRepository;
use App\Repositories\CountryRepository;
use App\Repositories\ShippingRuleRepository;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
     * @param Request $request
	 * @return Response
	 */
	public function index(Request $request)
	{
        $rules = $this->dispatchFrom(IndexShippingRulesCommand::class, $request);
		return view('shipping-rules.index')->with('collection', $rules);
	}

	/**
	 * Show the form for creating a new resource.
	 *
     * @param CarrierRepository $carriers
     * @param CountryRepository $countries
	 * @return Response
	 */
	public function create(CarrierRepository $carriers, CountryRepository $countries)
	{
		return view('shipping-rules.create')->with('carriers', $carriers->all())
            ->with('countries', $countries->all());
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
            $rule = $this->dispatchFrom(RegisterShippingRuleCommand::class, $request);
            flash()->success(trans('shipping-rules.create', ['carrier' => $rule->carrier->name, 'country' => $rule->country->name]));
            return redirect()->route('shipping-rule.edit', $rule->id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
        catch (QueryException $e) {
            flash()->warning($e->getCode() == 23000 ? trans('shipping-rules.already_exists') : $e->getMessage());
            return redirect()->back()->withInput();
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
     * @param ShippingRuleRepository $rules
	 * @return Response
	 */
	public function edit($id, ShippingRuleRepository $rules)
	{
		try {
            return view('shipping-rules.edit')->with('model', $rules->findById($id));
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('shipping-rules.not_found'));
            return redirect()->route('shipping-rule.index');
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
            $rule = $this->dispatchFrom(UpdateShippingRuleCommand::class, $request);
            flash()->success(trans('shipping-rules.updated', ['carrier' => $rule->carrier->name, 'country' => $rule->country->name]));
            return redirect()->route('shipping-rule.edit', $rule->id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('shipping-rules.not_found'));
            return redirect()->route('shipping-rule.index');
        }
        catch (\Exception $e) {
            flash()->warning($e->getMessage());
            return redirect()->back()->withInput();
        }
	}

}
