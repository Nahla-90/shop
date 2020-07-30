<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    /**
     * Created by Nahla Sameh
     * Listing products
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        /* Check if user authenticated to do this action */
        if (!$this->authenticate()) {
            return view('noaccess');
        }

        /* Fetch Products according to current page */
        $products = Product::latest()->paginate(5);

        /* Return products view */
        return view('product.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Created by Nahla Sameh
     * Create new product View
     * @ return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        /* Check if user authenticated to do this action */
        if (!$this->authenticate()) {
            return view('noaccess');
        }

        /* Return create product view */
        return view('product.create');
    }


    /**
     * Created by Nahla Sameh
     * Save new product or update existing one
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        /* Check if user authenticated to do this action */
        if (!$this->authenticate()) {
            return response()->json(array('errors' => array('message'=>'You Have no access')));
        }

        /* Validate Product data */
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:5',
            'detail' => 'required|string|min:10',
            'image' => 'required|string',
        ]);

        /* Check Product data validation*/
        if ($validator->fails()) {

            /* prepare error messages */
            $errors = array();
            foreach ($validator->errors()->getMessages() as $key => $message) {
                $errors[$key] = implode(', ', $message);
            }

            /* Return with error messages*/
            return response()->json(array('errors' => $errors));

        } else {

            /* Check if id not null ( if id exist then its update process)*/
            if ($request->id !== null) {

                /*Update existing product*/
                $product = Product::find($request->id);
                $product->update($request->all());

                return response()->json(array('success' => 'product updated successfuly'));
            } else {

                /*Create new product*/
                Product::create($request->all());

                return response()->json(array('success' => 'product added successfuly'));
            }

        }
    }


    /**
     * Created by Nahla Sameh
     * Show Product.
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        /* Check if user authenticated to do this action */
        if (!$this->authenticate()) {
            return view('noaccess');
        }

        /* Return show view*/
        return view('product.show', compact('product'));
    }


    /**
     * Created by Nahla Sameh
     * Show the form for editing the specified product.
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        /* Check if user authenticated to do this action */
        if (!$this->authenticate()) {
            return view('noaccess');
        }

        /* Return edit view*/
        return view('product.edit', compact('product'));

    }

    /**
     * Created by Nahla Sameh
     * Remove the specified product.
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        /* Check if user authenticated to do this action */
        if (!$this->authenticate()) {
            return view('noaccess');
        }

        /*Delete Product*/
        unlink(public_path('images/products').'/'.$product->image);
        $product->delete();


        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');

    }

    /**
     * Created by Nahla Sameh
     * upload product images
     * @return \Illuminate\Http\JsonResponse
     */
    public function imageUploadPost()
    {
        /* Check if user authenticated to do this action */
        if (!$this->authenticate()) {
            return response()->json(array('errors' => array('message'=>'You Have no access')));
        }
        /* Validate image formate*/
        request()->validate([
            'uploadImageFile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);

        /* renaming image*/
        $imageName = time() . '.' . request()->uploadImageFile->getClientOriginalExtension();

        /* Save image in specific path*/
        request()->uploadImageFile->move(public_path('images/products'), $imageName);

        return response()->json(array('success' => 'You have successfully upload image.', 'image' => $imageName));
    }
}
