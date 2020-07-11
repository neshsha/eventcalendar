@extends('layouts.appevent')
 
@section('content')

<div class="container">

  <div class="panel panel-primary">
 
    <div class="panel-heading">

      <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

       <h2 class="text-center">Calendar event schedule</h2>

       

    </div>
                      
    <div class="panel-body">    

        <div class="col-xs-12 col-sm-12 col-md-12">

            @if (Session::has('success'))

              <div class="alert alert-success">{{ Session::get('success') }}</div>

            @elseif (Session::has('warnning'))

              <div class="alert alert-danger">{{ Session::get('warnning') }}</div>
            @endif
 
        </div>
 
    </div>
 
  </div>


 
 <div class="panel panel-primary">

    <div class="panel-heading">MY Event Details</div>

      <div class="panel-body" >

                  {!! $calendar->calendar() !!}

      </div>

    </div>
 
  </div>



  <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>

              <h5 class="modal-title" id="exampleModalLabel">New event for </h5>
              
            </div>

            <div class="modal-body">
       
                {!! Form::open(array('route' => 'events.add','method'=>'POST','files'=>'true')) !!}

                  <div class="row">
         
                      <div class="col-xs-12 col-sm-12 col-md-12">

                          <div class="form-group">

                            {!! Form::label('event_name','Event Name:') !!}
                                <div class="">
                                  {!! Form::text('event_name', null, ['class' => 'form-control']) !!}
                                  {!! $errors->first('event_name', '<p class="alert alert-danger">:message</p>') !!}
                                </div>

                          </div>
                      </div>
 
                                  {!! Form::hidden('start_date', null, ['class' => 'form-control']) !!}
                                  {!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
                                
                                  {!! Form::hidden('end_date', null, ['class' => 'form-control']) !!}
                                  {!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}

                      
                      <div class="col-xs-1 col-sm-1 col-md-1 text-center mt-1"> &nbsp;<br/>

                      {!! Form::submit('Add Event',['class'=>'btn btn-primary']) !!}

                      </div>

                  </div>


              {!! Form::close() !!}


            </div>

          </div>

        </div>

      </div>



  <div class="modal" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLabel">New event for </h5>
        
        </div>

      <div class="modal-body">
  
        {!! Form::open(array('route' => 'events.update','method'=>'POST','files'=>'true')) !!}

          <div class="row">
 
              <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                  {!! Form::label('event_name','Event Name:') !!}

                      <div class="">
                            {!! Form::text('event_name', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('event_name', '<p class="alert alert-danger">:message</p>') !!}
                      </div>
                </div>

              </div>
 
                
                            {!! Form::hidden('start_date', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
                         
                            {!! Form::hidden('end_date', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}

                            {!! Form::hidden('id', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('id', '<p class="alert alert-danger">:message</p>') !!}
                
 
            <div class="col-xs-1 col-sm-1 col-md-12 text-center mt-1"> &nbsp;<br/>

                            {!! Form::submit('Update Event',['class'=>'btn btn-primary']) !!}

            </div>

            <div class="col-xs-1 col-sm-1 col-md-12 text-center mt-1">&nbsp;<br/>

                      <a href="/events/destroy" class="btn btn-danger float-right">Delete event</a>
            </div>

          </div>

        {!! Form::close() !!}
                   
        </div> 

      </div>    
  
    </div>

  </div>

@endsection