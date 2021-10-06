<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index()
    {
       //$properties = DB::select('select * from properties ');
       $properties = Property::all();

        return view('property/index')-> with('properties',$properties);
    }
    public function show($name)
    {
       //$property = DB::select('select * from properties where name = ?', [$name]);
        $property = Property::where('name', $name)->get();

       if(!empty($property)){
        return view('property/show')->with('property', $property);
       }    else {
           return redirect()->action('App\Http\Controllers\PropertyController@index', );
       }
    }

    public function create()
    {
        return view('property/create');
    }

    public function store(Request $request)
    {
        $propertySlug = $this->setName($request->title);

        //$properties=[
        // $request->title,
        // $propertySlug,
        // $request->descripition,
        // $request->rental_price,
        //$request->sale_price,
        //];

        //DB::insert("INSERT INTO properties (title, name, descripition, rental_price, sale_price)VALUES
        //(?, ?, ?, ?, ?)",  $properties);

        $property  =[
            'title' => $request->title,
            'name' => $propertySlug,
            'descripition' => $request->descripition,
            'rental_price' => $request->rental_price,
            'sale_price' => $request->sale_price,
        ];
        
        Property::create($property);

        return redirect()->action('App\Http\Controllers\PropertyController@index');
    }

    public function edit($name){

        //$property = DB::select('select * from properties where name = ?', [$name]);
        $property = Property::where('name', $name)->get();
       

       if(!empty($property)){
        return view('property/edit')->with('property', $property);
       }    else {
           return redirect()->action('App\Http\Controllers\PropertyController@index', );
       }
    }

    public function update(Request $request,$id){
         $propertySlug = $this->setName($request->title);

         //$properties=[
            //$request->title,
            //$propertySlug,
            //$request->descripition,
            //$request->rental_price,
            //$request->sale_price,
            //$id
        //];

        //DB::update("UPDATE properties SET title = ?, name = ?, descripition = ?, rental_price = ?, sale_price = ? 
        //WHERE id = ?",  $properties);

            $property = Property::find($id);

            $property->title = $request->title;
            $property->name = $propertySlug;
            $property->descripition = $request->descripition;
            $property->rental_price = $request->rental_price;
            $property->sale_price = $request->sale_price;

            $property->save();


    return redirect()->action('App\Http\Controllers\PropertyController@index', );
    }

    public function destroy($name){

        //$property = DB::select('select * from properties where name = ?', [$name]);
        $property = Property::where('name', $name)->get();

        if(!empty($property)){
            DB::delete('DELETE FROM properties where name = ?', [$name]);

            
        }

        return redirect()->action('App\Http\Controllers\PropertyController@index', );
    }

    private function setName($title){
        $propertySlug = Str::slug($title) ;

        //$properties = DB::select('select * from properties');
        $properties = Property::all();

        $t = 0;
        foreach($properties as $property){
           if (Str::slug($property->title) === $propertySlug){
                $t++;
           }
        }

        if($t > 0){
            $propertySlug = $propertySlug . '-' . $t;
        }

        return $propertySlug;
    }
}
