<?php namespace App\Http\Controllers;

use App\Commands\IndexProductsCommand;
use App\Commands\RegisterProductCommand;
use App\Commands\TrashProductCommand;
use App\Commands\UpdateProductCommand;
use App\Http\Requests;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTypeRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\VatRateRepository;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller {

    /**
	 * Display a listing of the resource.
	 *
     * @param Request $request
	 * @return Response
	 */
	public function index(Request $request)
	{
        $collection = $this->dispatchFrom(IndexProductsCommand::class, $request);
		return view('products.index')
            ->with('collection', $collection)
            ->with('q', $request->get('q'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
     * @param ProductTypeRepository $product_types
	 * @return Response
	 */
	public function create(ProductTypeRepository $product_types)
	{
		return view('products.create')->with('product_types', $product_types->all());
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
            $product = $this->dispatchFrom(RegisterProductCommand::class, $request);
            flash()->success(trans('products.created', ['description' => $product->description]));
            return redirect()->route('product.edit', $product->id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessageProvider());
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
     * @param ProductRepository $products
     * @param SupplierRepository $suppliers
     * @param VatRateRepository $vat_rates
	 * @return Response
	 */
	public function edit($id, ProductRepository $products, SupplierRepository $suppliers, VatRateRepository $vat_rates)
	{
        try {
            $product = $products->findById($id);
            return view('products.edit')->with('model', $product)
                ->with('suppliers', $suppliers->all())
                ->with('vat_rates', $vat_rates->all());
        }
        catch (ModelNotFoundException $e) {
            flash()-warning(trans('products.not_found'));
            return redirect()->route('product.index');
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
            $product = $this->dispatchFrom(UpdateProductCommand::class, $request);
            flash()->success(trans('products.updated', ['description' => $product->description]));
            return redirect()->route('product.edit', $product->id);
        }
        catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
        catch (ModelNotFoundException $e) {
            flash()->warning(trans('products.not_found'));
            return redirect()->route('product.index');
        }
        catch (\Exception $e) {
            flash()->warning($e->getMessage());
            return redirect()->back()->withInput();
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
     * @param Request $request
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
        try {
            $request->merge(compact('id'));
            $product = $this->dispatchFrom(TrashProductCommand::class, $request);
            flash()->success(trans('products.trashed', ['description' => $product->description]));
            return redirect()->route('product.index');
        }
        catch (\Exception $e) {
            flash()->warning($e->getMessage());
            return redirect()->back();
        }
	}

}
