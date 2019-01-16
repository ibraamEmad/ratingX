@extends('layouts.app')
@section('content')

    <div  class="col-sm-9">
        <input type="text"  class="form-control" name="search" placeholder="Search.." id="searched">
        </div>
        <br>
        <br>
        <br>
        @foreach($movies as $movie)
        
                <div style="display:inline-block;" class="col-sm-3" id=movie{{$movie->id}}>
                  <div class="card">
                        <div class="card-header">
                            <center> <h3>   {{$movie->name}}  </h3></center>
                              </div>
                    <div class="card-body">
                            <img class="card-img-top" style="display: block;margin-left: auto;margin-right: auto " src=/images/{{$movie->image}} height="400" width="300">
                        <br><br>
                        Rating: {{$movie->rate}}
                        <br><br>
                      <p class="card-text">{{$movie->description}}</p>
                    <center>  <a href="#" class="btn btn-primary rate" data-toggle="modal" data-target="#myModal{{$movie->id}}"  id="modal{{$movie->id}}">Rate</a> </center>
                    </div>
                    <div class="card-footer text-muted">
                            Release date: {{$movie->releaseDate}}
                          </div>
                  </div>
                </div>
             
                <div class="modal fade" id="myModal{{$movie->id}}" role="dialog">
                  <div class="modal-dialog">
                  
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                     <!--   <button type="button" class="close" data-dismiss="modal">&times;</button>-->
                        <center><h4 class="modal-title">{{$movie->name}}</h4></center> 
                      </div>
                      <div class="modal-body">
                            
                        <div class="stars">
                          <form action="">
                            <input class="star star-5" type="radio" name="star" class="star"/>
                            <label class="star star-5" for="star-5" id="{{$movie->id}}-5"></label>
                            <input class="star star-4" type="radio" name="star" class="star"/>
                            <label class="star star-4" for="star-4" id="{{$movie->id}}-4"></label>
                            <input class="star star-3" type="radio" name="star" class="star"/>
                            <label class="star star-3" for="star-3" id="{{$movie->id}}-3"></label>
                            <input class="star star-2" type="radio" name="star" class="star"/>
                            <label class="star star-2" for="star-2" id="{{$movie->id}}-2"></label>
                            <input class="star star-1" type="radio" name="star" class="star"/>
                            <label class="star star-1" for="star-1" id="{{$movie->id}}-1"></label>
                          </form>
                        </div>
        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div> 
                    </div>
                    
                  </div>
                </div>
        @endforeach
        
@endsection
