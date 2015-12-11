<?php namespace App\Http\Controllers;

use App\Commands\IndexProductTypesCommand;
use App\Commands\RegisterProductTypeCommand;
use App\Commands\UpdateProductTypeCommand;
use App\Http\Requests;
use App\Repositories\AttributeRepository;
use App\Repositories\ProductTypeRepository;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductTypeController extends Controller {

    /**
	 * Display a listing of the resource.
	 *
     * @param Request $request
	 * @return Response
	 */
	public function index(Request $request)
	{
		$types = $this->dispatchFrom(IndexProductTypesCommand::class, $request);
        return view('product-types.index')->with('collection', $types)
            ->with('q', $request->get('q'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('product-types.create');
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
            $type = $this->dispatchFrom(RegisterProductTypeCommand::class, $request);
            flash()->success(trans('product-types.created', ['description' => $type->description]));
            return redirect()->route('product-type.edit', $type->id);
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
     * @param ProductTypeRepository $types
     * @param AttributeRepository $attributes
	 * @return Response
	 */
	public function edit($id, ProductTypeRepository $types, AttributeRepository $attributes)
	{
		try {
            return view('product-types.edit')->with('model', $types->findById($id, true))
                ->with('attributes', $attributes->all());
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('product-types.not_found'));
            return redirect()->route('product-type.index');
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
            $type = $this->dispatchFrom(UpdateProductTypeCommand::class, $request);
            flash()->success(trans('product-types.updated', ['description' => $type->description]));
            return redirect()->route('product-type.edit', $id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('product-types.not_found'));
            return redirect()->route('product-type.index');
        }
        catch (\Exception $e) {
            flash()->warning($e->getMessage());
            return redirect()->back()->withInput();
        }
	}

}
