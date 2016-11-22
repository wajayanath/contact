
  <div class="panel-body">
    <div class="form-horizontal">
      <div class="row">
          <div class="col-md-8">
{{--                 @if(count($errors))
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif --}}
            <div class="form-group">
            <label for="name" class="control-label col-md-3">Name</label>
            <div class="col-md-8">

            {{ $contact->name }}

            </div>
          </div>

          <div class="form-group">
            <label for="company" class="control-label col-md-3">Company</label>
            <div class="col-md-8">

            {{ $contact->company }}

            </div>
          </div>

          <div class="form-group">
            <label for="email" class="control-label col-md-3">Email</label>
            <div class="col-md-8">

            {{ $contact->email }}

            </div>
          </div>

          <div class="form-group">
            <label for="phone" class="control-label col-md-3">Phone</label>
            <div class="col-md-8">

            {{ $contact->phone }}

            </div>
          </div>

          <div class="form-group">
            <label for="name" class="control-label col-md-3">Address</label>
            <div class="col-md-8">

            {{ $contact->address }}

            </div>
          </div>
      </div>
        <div class="col-md-4">
          <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
             <?php $photo = !is_null($contact->photo) ? $contact->photo : 'default.jpg' ?>
             {!! Html::image('uploads/'. $photo, $contact->name, ['class'=> 'media-object']) !!}
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
            <div>
            <ul class="bxslider">
                @foreach ($contact->photos as $photo)
                  <li><img src="../../images/full_size/{{ $photo->path }}" alt=""></li>
                @endforeach
            </ul> 
          </div>
        </div>
      </div>

    </div>
  </div>
  
   