
  <div class="panel-body">
    <div class="form-horizontal">

       <div class="row">
        <div class="col-md-12">
            <div>
            <ul class="bxslider">
                @foreach ($contact->photos as $photo)
                  <li><img src="../../images/full_size/{{ $photo->path }}" alt=""></li>
                @endforeach
            </ul> 
            <ul id="bx-pager">
                @foreach ($contact->photos as $index => $photo)
                  <a data-slide-index="{{ $index }}" href=""><img src="../../images/icon_size/{{ $photo->path }}" /></a>
                @endforeach
            </ul> 
            </div>
        </div>
      </div>

      <div class="row">
         <div class="col-md-12">
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
      </div>
    </div>
  </div>
  
   