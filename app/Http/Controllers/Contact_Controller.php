<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\User;
class Contact_Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        // $user = Contact::orderBy('created_at', 'desc')->paginate(5);
        return view('contact')->with('contacts', $user->contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //this is validation for submitting data
         $this->validate($request, [
            'name' => 'required',
            'company' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        //Create Post
        $contact = new Contact;
        $contact->name = $request->input('name');
        $contact->company = $request->input('company');
        $contact->phone = $request->input('phone');
        $contact->email = $request->input('email');
        $contact->user_id = auth()->user()->id;
        $contact->save();

        return redirect('contact')->with('success', 'Successfully Added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('contact.edit')->with('contact', $contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //this is validation for submitting data
        $this->validate($request, [
            'name' => 'required',
            'company' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        //Create Post
        $contact = Contact::find($id);
        $contact->name      = $request->input('name');
        $contact->company   = $request->input('company');
        $contact->phone     = $request->input('phone');
        $contact->email     = $request->input('email');
        $contact->user_id   = auth()->user()->id;
        $contact->save();

        return redirect('contact')->with('success', 'Successfully Updated');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        return redirect('contact')->with('success', 'Successfully Deleted');
    }

    public function search(Request $request){
       if($request->ajax()){
           $query = $request->get('query');
           if($query != ''){
               $data = Contact::where('name', 'like', '%'.$query.'%')
               ->orWhere('company', 'like', '%'.$query.'%')
               ->orWhere('phone', 'like', '%'.$query.'%')
               ->orWhere('email', 'like', '%'.$query.'%')
               ->orderBy('id', 'desc')
               ->get();
           } else {
               $data = Contact::orderBy('id', 'desc')->get();
           }
           $total_row = $data->count();
           if($total_row > 0){
               foreach($data as $row){
                   $output .= `
                   <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->company }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->email }}</td>
                        <td>
                            <a href='/ContactSystem/public/contact/{{ $row->id }}/edit' class="btn btn-primary">Edit</a> 
                        </td> 
                            <td>
                            {!! Form::open(['action' => ['Contact_Controller@destroy', $row->id], 'method' => 'POST', 'class' => 'pull-right'])  !!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {!! Form::close()!!}
                        </td> 
                    </tr>
                   `;
               }
           } else {
                $output = `
                    <tr>
                        <td align="center" colspan="5">
                            No data found
                        </td>
                    </tr>
                `;
           }
           $data = array(
                'table_data' => $output
            );
            echo json_encode($data);
       }
    }


}
