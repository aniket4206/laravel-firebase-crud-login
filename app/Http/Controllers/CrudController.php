<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Database;
use Kreait\Firebase\Firestore;


class CrudController extends Controller
{
    
    public function __construct(Firestore $firestore)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $this->firestore = $firestore;
        $this->database = $database;
        $this->tablename = 'User';
        
    }
  
    public function index()
    {
       
        return view('firebase.data.index');
    }

   
    public function insert()
    {
        
        return view('firebase.data.insert');
    }

    public function update(Request $req)
    {
        $data = $req->input();
        $firestore = app('firebase.firestore');
        $database = $firestore->database();


         # [START firestore_data_set_field]
        $cityRef = $this->$database->collection('User')->document('name');
        $cityRef->update([
            ['path' => 'name', 'value' => true]
        ]);
        // $firestore = app('firebase.firestore');
       
        // $usersRef = $database->collection('User');
        // $userDoc = $usersRef->documents();
        // $key = $id;
        // // $data = $req->input();
        // // print_r($key);
        // $editData = $this->$database->getReference('User')->getChild($key)->getValue();
        // $editData=[];
        // if($editData){
        //     return view('firebase.data.update', ['editData' => $editData]);
        // }
        // else
        // {
        //     return redirect('update')->with('status','Contact Id Not Found');
        // }
        // $firestore = app('firebase.firestore');

        // $database = $firestore
        //     ->database()
        //     ->collection('Cities')
        //     ->document($data['city_update_id'])
        //     ->update([
        //         ['path' => 'name', 'value' => $data['city_name_update']],
        //     ]);
        // $data = $req->input();
        //print_r($data);

        // $firestore = app('firebase.firestore');

        // $database = $firestore
        //     ->database()
        //     ->collection('User')
        //     ->document($data['name'])
        //     ->update([
        //         ['path' => 'name', 'value' => $data['']],
        //     ]);

        //print_r('Updated the DC document in the cities collection.' . PHP_EOL);

        // return redirect('/admin/Cities')->with(
        //     'success',
        //     ' Updated Successfully'
        // );
        return view('firebase.data.update');
    }

    public function view()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $usersRef = $database->collection('User');
        $userDoc = $usersRef->documents();

        $usersData = [];
        foreach ($userDoc as $document) {
            if ($document->exists()) {
                array_push($usersData, [$document->id(), $document->data()]);
            } else {
                return back()->with('warning', 'Data not exist');
            }
        }
        // print_r($usersData);
        return view('firebase.data.view', ['usersData' => $usersData]);
    }

    

    public function delete(Request $req)
    {
        // $data = $req->input();
        

        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $deleteDocRef = $database
        //     ->collection('User')
        //     ->document($data[x])
        //     ->delete();
        
            // return view('firebase.data.del')->with(
            //     'status',
            //     ' Deleted Successfully'
            // );        
            // return redirect('firebase.data.delete');
    }

   
    public function store(Request $req)
    {
        // //
        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $data = $request->input();
        
        // $postData = [
        //     'name' => $data['name'],
        //     'name' => $data['email'],
        //     'name' => $data['age'],
        // ];
        // $postRef = $this->$database->getReference($this->tablename)->push($postData);
        // if($postRef)
        // {
        //     return redirect('index')->with('status','Contact Added Successfully..');
        // }
        // else
        // {
        //     return redirect('index')->with('status','Contact Not Added Successfully..');
        // }
        $data = $req->input();
        //print_r($data['city_name']);

        $dataToPush = [
            'name' => $data['name'],
            'email' => $data['name'],
            'age' => $data['age'],
        ];

        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $addedDocRef = $database->collection('User')->add($dataToPush);
        //printf('Added document with ID: %s' . PHP_EOL, $addedDocRef->id());

        if ($addedDocRef) {
            return redirect('index')->with('status','Contact Added Successfully..');
            // $usertype = session('admin');

            // $cities = [];
            // if ($usertype['role'] == 'super_admin') {
            //     $citiesRef = $database->collection('Cities');
            //     $documents = $citiesRef->documents();
                
            //     foreach ($documents as $document) {
            //         if ($document->exists()) {
            //             array_push($cities, [
            //                 $document->id(),
            //                 $document->data()['name'],
            //                 $document->data()['status'],
            //             ]);
                        
                    } else {
                        return redirect('index')->with('status','Contact Not Added Successfully..');
                        // printf(
                        //     'Document %s does not exist!' . PHP_EOL,
                        //     $document->id()
                        // );
                        // return redirect('/index')->with(
                        //     'success',
                        //     $data['name'] . ' Added Successfully'
                        // );
                    }
    }


                // session(['cities' => $cities]);
  
    
    function update_data(Request $req, $id)
    {
        //
        // $data = $req->input();
        //print_r($data);

        // $firestore = app('firebase.firestore');

        // $database = $firestore
        //     ->database()
        //     ->collection('Cities')
        //     ->document($data['city_update_id'])
        //     ->update([
        //         ['path' => 'name', 'value' => $data['city_name_update']],
        //     ]);

        //print_r('Updated the DC document in the cities collection.' . PHP_EOL);

        // return redirect('index')->with(
        //     'status',
        //     ' Updated Successfully'
        // );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
