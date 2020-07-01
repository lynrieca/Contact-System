@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 ">
            <div class="row" align="right">
                    {!! Form::open([]) !!}
                    <div class="form-group">
                        {{Form::text('name','', ['class'=>'form-control', 'placeholder'=>"Search"])}}
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="row">
                <div class="col text-center title">
                    <h1>Contact Detail</h1>
                </div>
            </div>
            <div class="row">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="panel-body">
                    @if(count($contacts) > 0 )
                    <table class="table" style="color: #e7bd74; ">
                        <thead class="thead-inverse">
                            <tr>
                                <th class="table-header">Name</th>
                                <th class="table-header">Company</th>
                                <th class="table-header">Phone</th>
                                <th class="table-header">Email</th>
                                <th class="table-header" colspan="2">Action</th>
                            </tr>
                        </thead>
                        
                        @foreach($contacts as $contact)
                        <tbody >
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->company }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>
                                    <a href='/ContactSystem/public/contact/{{ $contact->id }}/edit' class="btn btn-primary">Edit</a> 
                                </td> 
                                 <td>
                                    {!! Form::open(['action' => ['Contact_Controller@destroy', $contact->id], 'method' => 'POST', 'class' => 'pull-right'])  !!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!! Form::close()!!}
                                </td> 
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @else
                        <p>You have no post</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function(){

        $('.search').on('keyup', function() {
            var query = $(this).val();
            console.log('query', query);
            $.ajax({
                // url : "{{'Contact_Controller@search'}}",
                url : 'contact/search',
                type: 'GET',
                data : {query},
                success:function(data)
                {
                    console.log(data);
                    $('tbody').html(data.table_data);
                },
                error: function(data){
                    console.log('erorr', error)
                }
            })
        })

        // $(document).on('keyup', '.search', function(){
        //     var query = $(this).val();
        //     alert();
        //     fetch_contact_data(query);
        // })
    })
    
</script>
@endsection
