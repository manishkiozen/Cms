<?php namespace App\Http\Controllers;

use App\Commands\IndexSuppliersCommand;
use App\Commands\RegisterSupplierCommand;
use App\Commands\UpdateSupplierCommand;
use App\Http\Requests;
use App\Repositories\SupplierRepository;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SupplierController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
     * @param Request $request
	 * @return Response
	 */
	public function index(Request $request)
	{
        $suppliers = $this->dispatchFrom(IndexSuppliersCommand::class, $request);
		return view('suppliers.index')->with('collection', $suppliers)
            ->with('q', $request->get('q'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('suppliers.create');
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
            $supplier = $this->dispatchFrom(RegisterSupplierCommand::class, $request);
            flash()->success(trans('suppliers.created', ['name' => $supplier->name]));
            return redirect()->route('supplier.edit', $supplier->id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
     * @param SupplierRepository $suppliers
	 * @return Response
	 */
	public function edit($id, SupplierRepository $suppliers)
	{
		try {
            return view('suppliers.edit')->with('model', $suppliers->findById($id));
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('suppliers.not_found'));
            return redirect()->route('supplier.index');
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
            $supplier = $this->dispatchFrom(UpdateSupplierCommand::class, $request);
            flash()->success(trans('suppliers.updated', ['name' => $supplier->name]));
            return redirect()->route('supplier.edit', $supplier->id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('suppliers.not_found'));
            return redirect()->route('supplier.index');
        }
        catch (\Exception $e) {
            flash()->warning($e->getMessage());
            return redirect()->back()->withInput();
        }
	}

}
