  @include('layouts.partials.header')
  @include('layouts.partials.navbar')

    <!-- content -->
    <div class="container">
      <div class="row">
        <div class="col-md-3">

    @if (! Auth::guest())
          <div class="list-group">
          <?php $selected_group = Request::get("group_id");
                $listGroups = listGroups(Auth::user()->id);
           ?>
            <a href="{{ route('contacts.index') }}" class="list-group-item {{ empty($selected_group) ? 'active' : '' }}">All Ads<span class="badge">{{ collect($listGroups)->sum('total') }}</span>
            </a>
            @foreach ($listGroups as $group)
              <a href="{{ route('contacts.index', ['group_id' => $group->id ]) }}" class="list-group-item {{ $selected_group == $group->id ? 'active' : '' }}">{{ $group->name }}<span class="badge">{{ $group->total }}</span></a>
            @endforeach
          </div>
     @else
        <div class="list-group">
           <?php $selected_group = Request::get("group_id");
                $listGroups = App\Group::all();
           ?> 
            <a href="{{ route('all.index') }}" class="list-group-item {{ empty($selected_group) ? 'active' : '' }}">All Ads<span class="badge">{{ App\Contact::count() }}</span>
            </a>
            
            @foreach (App\Group::all() as $group)
              <a href="{{ route('all.index', ['group_id' => $group->id ]) }}" class="list-group-item {{ $selected_group == $group->id ? 'active' : '' }}">{{ $group->name }}<span class="badge">{{ $group->contacts->count() }}</span></a>
            @endforeach 
          </div>
     @endif
       
       </div>
        <div class="col-md-9">
          @if(session('message'))
          <div class="alert alert-success">
            {{ session('message') }}
          </div>  
          @endif
             @yield('content')
        </div>
      </div>
    </div>

 @include('layouts.partials.footer')