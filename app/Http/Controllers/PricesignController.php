<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pricesign;

class PricesignController extends Controller
{

    public function index()
    {
        $pricesigns = Pricesign::all();
        return response()->json($pricesigns);
    }

    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            'title' => 'required',
            'articlenumber' => 'required',
            'price' => 'required',
            'photo' => 'required',
            'description' => 'required'
        ]);

        $pricesign = new Pricesign();

        //image upload
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $allowedfileextensions = ['png', 'jpg', 'jpeg'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileextensions);

            if($check){
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $pricesign->photo = $name;
            }
        }

        $pricesign->title = $request->input('title');
        $pricesign->articlenumber = $request->input('articlenumber');
        $pricesign->price = $request->input('price');
        $pricesign->description = $request->input('description');

        $pricesign->save();

        return response()->json($pricesign);
    }

    public function show($id)
    {
        $pricesign = Pricesign::find($id);
        return response()->json($pricesign);
    }

    public function update(Request $request, $id)
    {
        //validation
        $this->validate($request, [
            'title' => 'required',
            'articlenumber' => 'required',
            'price' => 'required',
            'photo' => 'required',
            'description' => 'required'
        ]);

        $pricesign = Pricesign::find($id);


        //image upload
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $allowedfileextensions = ['png', 'jpg', 'jpeg', 'JPEG', 'PNG'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileextensions);

            if($check){
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                unlink("images/".$pricesign->photo);
                $pricesign->photo = $name;
            }
        }


        $pricesign->title = $request->input('title');
        $pricesign->articlenumber = $request->input('articlenumber');
        $pricesign->price = $request->input('price');
        $pricesign->description = $request->input('description');

        $pricesign->save();

        return response()->json($pricesign);
    }

    public function destroy($id)
    {
        $pricesign = Pricesign::find($id);
        unlink("images/".$pricesign->photo);
        $pricesign->delete();
        return response()->json('Product Deleted Sucessfully');
    }
}
