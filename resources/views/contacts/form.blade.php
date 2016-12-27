
  <div class="panel-body">
    <div class="form-horizontal">
      <div class="row">
          <div class="col-md-12">
                @if(count($errors))
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
            <div class="form-group">
            <label for="name" class="control-label col-md-3">Name</label>
            <div class="col-md-8">

            {!! Form::text("name",null, ['class' => 'form-control']) !!}

            </div>
          </div>

          <div class="form-group">
            <label for="company" class="control-label col-md-3">Company</label>
            <div class="col-md-8">

            {!! Form::text("company",null, ['class' => 'form-control']) !!}

            </div>
          </div>

          <div class="form-group">
            <label for="email" class="control-label col-md-3">Email</label>
            <div class="col-md-8">

            {!! Form::email("email",null, ['class' => 'form-control']) !!}

            </div>
          </div>

          <div class="form-group">
            <label for="phone" class="control-label col-md-3">Phone</label>
            <div class="col-md-8">

            {!! Form::text("phone",null, ['class' => 'form-control']) !!}

            </div>
          </div>

          <div class="form-group">
            <label for="name" class="control-label col-md-3">Address</label>
            <div class="col-md-8">

            {!! Form::textarea("address",null, ['class' => 'form-control', 'rows' =>2]) !!}

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel-footer">
    <div class="row">
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-offset-3 col-md-6">
            <button type="submit" class="btn btn-primary">{{ ! empty($contact->id) ? "Update" : "Save" }}</button>
            <a href="#" class="btn btn-default">Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>
