@extends('layouts.main')

@section('content')

	<div class="panel panel-default">
		<div class="pannel-heading clearfix">
			<div class="pull-left col-md-10">
				<h4>All Contacts</h4>
			</div>
		@if (! Auth::guest())	
			<div class="pull-right col-md-2">
				<a href="{{ route('contacts.create') }}" class="btn btn-success">
	              <i class="glyphicon glyphicon-plus"></i> 
	              Add Contact
	            </a>
			</div>
		@endif
		</div>
	</div>
            <table class="table">
             @foreach ($contacts as $contact) 
	              <tr>
	                <td class="middle">
	                  <div class="media">
	                    <div class="media-left">
	                      <a href="#">
	                      <?php $photo = !is_null($contact->photo) ? $contact->photo : 'default.jpg' ?>
	                      <?php 
	                      $image = App\Photo::where('contact_id', 'like', $contact->id)->first();
	                       ?>
 							{!! Html::image('images/icon_size/'. $image['path'], $contact->name, ['class'=> 'media-object', 'width' => 100, 'height' => 100 ]) !!}
	                      </a>
	                    </div>
	                    <div class="media-body">
	                    <?php 
			                     $temp = $contact->name;	
			                     $temp2 = str_replace(' ','-', $temp);
	                      ?>
						@if (! Auth::guest())
	                      <h4 class="media-heading"><a href="contacts/{{ $contact->id."-from-".$temp2 }}">{{ $contact->name }}</a></h4>
	                    @else
	                    <h4 class="media-heading"><a href="{{ $contact->id."-from-".$temp2 }}">{{ $contact->name }}</a></h4>  
						@endif
	                      <address>
	                        <strong>{{ $contact->company }}</strong><br>
	                        {{ $contact->email }}
	                      </address>
	                    </div>
	                  </div>
	                </td>
	                <td width="100" class="middle">

					@if (! Auth::guest())
	                  <div>
	                  	{!! Form::open(['route' => ['contacts.destroy', $contact->id], 'method' => 'DELETE']) !!}
	                    <a href="{{ route('contacts.edit', ['id' => $contact->id]) }}" class="btn btn-circle btn-default btn-xs" title="Edit">
	                      <i class="glyphicon glyphicon-edit"></i>
	                    </a>

						<button class="btn btn-circle btn-danger btn-xs" title="Delete" onclick="return confirm('Are You sure ?')">
						<i class="glyphicon glyphicon-remove"></i>
						</button>
	                    {!! Form::close() !!}
	                  </div>
					@endif
	                  
	                </td>
	             </tr>
			 @endforeach 
            </table>            
          </div>

          <div class="text-center">
            <nav>
              {!! $contacts->appends( Request::query() )->render() !!}
            </nav>
          </div>

@endsection

