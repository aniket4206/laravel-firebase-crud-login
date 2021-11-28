<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class City extends Controller
{
    //

    function changeCity($city)
    {
        $cities = session('cities');

        if ($cities == null) {
            session()->pull('admin', null);
            return redirect('admin/login');
        }
        foreach ($cities as $ct) {
            if ($city == $ct[0]) {
                session(['currentCity' => [$ct[0], $ct[1], $ct[2]]]);
            }
        }
        

        return redirect('admin/Dashboard');
    }

    function getCities()
    {
        //if (!session()->has('admin')) {
        //    return view('admin/index');
        //}

        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $currentCity = session('currentCity');

        session(['sidelink' => 'cities']);

        $citiesRef = $database->collection('Cities');
        $citiesDoc = $citiesRef->documents();

        $citiesData = [];
        foreach ($citiesDoc as $document) {
            if ($document->exists()) {
                array_push($citiesData, [$document->id(), $document->data()]);
            } else {
                return back()->with('warning', 'Data not exist');
            }
        }

        //rsort(($orderData));

        //print_r($orderData);
        return view('/admin/settings/cities', ['citiesData' => $citiesData]);
    }

    function addCity(Request $req)
    {
       

        $data = $req->input();
        //print_r($data['city_name']);

        $dataToPush = [
            'name' => $data['city_name'],
            'status' => 'Private',
        ];

        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $addedDocRef = $database->collection('Cities')->add($dataToPush);
        //printf('Added document with ID: %s' . PHP_EOL, $addedDocRef->id());

        if ($addedDocRef->id()) {

            $usertype = session('admin');

            $cities = [];
            if ($usertype['role'] == 'super_admin') {
                $citiesRef = $database->collection('Cities');
                $documents = $citiesRef->documents();
                
                foreach ($documents as $document) {
                    if ($document->exists()) {
                        array_push($cities, [
                            $document->id(),
                            $document->data()['name'],
                            $document->data()['status'],
                        ]);
                        
                    } else {
                        printf(
                            'Document %s does not exist!' . PHP_EOL,
                            $document->id()
                        );
                    }
                }


                session(['cities' => $cities]);

            }



            return redirect('/admin/Cities')->with(
                'success',
                $data['city_name'] . ' Added Successfully'
            );
        }
    }

    function deleteCity(Request $req)
    {
       

        $data = $req->input();
        //print_r($data['id']);

        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $deleteDocRef = $database
            ->collection('Cities')
            ->document($data[x])
            ->delete();

        //print_r('Deleted the DC document in the cities collection.' . PHP_EOL);

        return redirect('/admin/Cities')->with(
            'success',
            ' Deleted Successfully'
        );
    }

    function updateCity(Request $req)
    {

        $data = $req->input();
        //print_r($data);

        $firestore = app('firebase.firestore');

        $database = $firestore
            ->database()
            ->collection('Cities')
            ->document($data['city_update_id'])
            ->update([
                ['path' => 'name', 'value' => $data['city_name_update']],
            ]);

        //print_r('Updated the DC document in the cities collection.' . PHP_EOL);

        return redirect('/admin/Cities')->with(
            'success',
            ' Updated Successfully'
        );
    }

    function publicCity($cityID)
    {

        //print_r($cityID);
  
        $firestore = app('firebase.firestore');

        $database = $firestore
            ->database()
            ->collection('Cities')
            ->document($cityID)
            ->update([
                ['path' => 'status', 'value' => 'Public'],
            ]);

        //print_r('Updated the DC document in the cities collection.' . PHP_EOL);

        return redirect('/admin/Cities')->with(
            'success',
            ' Status Updated Successfully'
        );

    }


    function privateCity($cityID)
    {
       

        //print_r($cityID);
  
        $firestore = app('firebase.firestore');

        $database = $firestore
            ->database()
            ->collection('Cities')
            ->document($cityID)
            ->update([
                ['path' => 'status', 'value' => 'Private'],
            ]);

        //print_r('Updated the DC document in the cities collection.' . PHP_EOL);

        return redirect('/admin/Cities')->with(
            'success',
            ' Status Updated Successfully'
        );

    }

    
    function getCityList(){

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $cityRef = $database->collection('Cities');
        $bookingQuery = $cityRef->where('status', '=', 'Public');
        $cityDoc = $bookingQuery->documents();

        $cityData = [];
        foreach ($cityDoc as $document) {
            if ($document->exists()) {
                array_push($cityData, [$document->id(), $document->data()]);
            } else {
                return back()->with('warning', 'Data not exist');
            }
        }


        return response()->json(['cityData'=>$cityData]);
    
    }


}