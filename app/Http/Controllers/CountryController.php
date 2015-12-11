<?php namespace App\Http\Controllers;

use App\Commands\IndexCountriesCommand;
use App\Commands\RegisterCountryCommand;
use App\Commands\UpdateCountryCommand;
use App\Http\Requests;
use App\Repositories\CountryRepository;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CountryController extends Controller {

    /**
	 * Display a listing of the resource.
	 *
     * @param Request $request
	 * @return Response
	 */
	public function index(Request $request)
	{
        $collection = $this->dispatchFrom(IndexCountriesCommand::class, $request);
		return view('countries.index')->with('collection', $collection)
            ->with('q', $request->get('q'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('countries.create');
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
            $country = $this->dispatchFrom(RegisterCountryCommand::class, $request);
            flash()->success(trans('countries.created', ['name' => $country->name]));
            return redirect()->route('country.edit', $country->id);
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
     * @param CountryRepository $countries
	 * @return Response
	 */
	public function edit($id, CountryRepository $countries)
	{
        try {
            $country = $countries->findById($id);
            return view('countries.edit')->with('model', $country);
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('countries.not_found'));
            return redirect()->route('country.index');
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
            $country = $this->dispatchFrom(UpdateCountryCommand::class, $request);
            flash()->success(trans('countries.updated', ['name' => $country->name]));
            return redirect()->route('country.edit', $country->id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('countries.not_found'));
            return redirect()->route('country.index');
        }
        catch (\Exception $e) {
            flash()->warning($e->getMessage());
            return redirect()->back()->withInput();
        }
	}

}
