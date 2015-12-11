<?php namespace App\Http\Controllers;

use App\Attribute;
use App\Commands\IndexAttributesCommand;
use App\Commands\RegisterAttributeCommand;
use App\Commands\UpdateAttributeCommand;
use App\Http\Requests;
use App\Repositories\AttributeRepository;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AttributeController extends Controller {

    /**
	 * Display a listing of the resource.
	 *
     * @param Request $request
	 * @return Response
	 */
	public function index(Request $request)
	{
        $collection = $this->dispatchFrom(IndexAttributesCommand::class, $request);
		return view('attributes.index')->with('collection', $collection)
            ->with('q', $request->get('q'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('attributes.create')->with('allowed_types', Attribute::getAllowedTypes());
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
            $attribute = $this->dispatchFrom(RegisterAttributeCommand::class, $request);
            flash()->success(trans('attributes.created', ['description' => $attribute->description]));
            return redirect()->route('attribute.edit', $attribute->id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
     * @param AttributeRepository $attributes
	 * @return Response
	 */
	public function edit($id, AttributeRepository $attributes)
	{
		try {
            return view('attributes.edit')->with('model', $attributes->findById($id));
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('attributes.not_found'));
            return redirect()->route('attribute.index');
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
            $attribute = $this->dispatchFrom(UpdateAttributeCommand::class, $request);
            flash()->success(trans('attributes.updated', ['description' => $attribute->description]));
            return redirect()->route('attribute.edit', $attribute->id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('attributes.not_found'));
            return redirect()->route('attributes.index');
        }
        catch (\Exception $e) {
            flash()->warning(trans($e->getMessage()));
            return redirect()->back()->withInput();
        }
	}

}
