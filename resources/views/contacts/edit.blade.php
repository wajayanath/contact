@extends('layouts.main')

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
    <strong>Edit Contact</strong>
  </div>
  {!! Form::model($contact, ['files' => true, 'method' => 'PATCH', 'route' => ['contacts.update', $contact->id]]) !!}
    @include('contacts.form')
  {!! Form::close() !!}

</div>


{{-- <form id="addPhotoForm" action="/contacts/{{ $contact->id }}/{{ $contact->name }}/photos" method="POST" class="dropzone">
	{{ csrf_field() }}
</form> --}}

	<div class="table table-striped files" id="previews">

        <div id="template" class="file-row">
            <!-- This is used as the file preview template -->
            <div>
                <span class="preview"><img data-dz-thumbnail /></span>
            </div>
            <div>
                <p class="name" data-dz-name></p>
                <strong class="error text-danger" data-dz-errormessage></strong>
            </div>
            <div>
                <p class="size" data-dz-size></p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
            </div>
            <div>
                <button class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
                <button data-dz-remove class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
                <button data-dz-remove class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
            </div>
        </div>
    </div>
    

 	<div id="actions" class="row">

        <div class="col-lg-7">
            <!-- The fileinput-button span is used to style the file input field as button -->
        <span class="btn btn-success fileinput-button">
            <i class="glyphicon glyphicon-plus"></i>
            <span>Add files...</span>
        </span>
           {{--  <button type="submit" class="btn btn-primary start">
                <i class="glyphicon glyphicon-upload"></i>
                <span>Start upload</span>
            </button>
            <button type="reset" class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span>Cancel upload</span>
            </button> --}}
        </div>

        <div class="col-lg-5">
            <!-- The global file processing state -->
        <span class="fileupload-process">
          <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
              <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
          </div>
        </span>
        </div>
    </div>
<script>
        
            // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template");
            previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode);
        var foo;    

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
              url: "/contacts/{{ $contact->id }}/{{ $contact->name }}/photos", // Set the url
              thumbnailWidth: 80,
              thumbnailHeight: 80,
              parallelUploads: 20,
              previewTemplate: previewTemplate,
              autoQueue: false, // Make sure the files aren't queued until manually added
              previewsContainer: "#previews", // Define the container to display the previews
              clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
              headers: {
            	'X-CSRF-TOKEN': '{!! csrf_token() !!}'
       		 },
       		 removedfile: function(file) {
    			    //var name = file.name;
              		$.ajax({
    			        type: 'POST',
    			        url: "/photo/"+foo.path,
    			        headers: {
            			'X-CSRF-TOKEN': '{!! csrf_token() !!}'
       					},
    			        //data: "id="+name,
    			        dataType: 'html'
    			    });
      				var _ref;
      				return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
            }
        });

            
            myDropzone.on("addedfile", function(file) {
              // Hookup the start button
              file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
            });

            // Update the total progress bar
            myDropzone.on("totaluploadprogress", function(progress) {
              document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
            });

            myDropzone.on("sending", function(file) {
              // Show the total progress bar when upload starts
              document.querySelector("#total-progress").style.opacity = "1";
              // And disable the start button
              file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
            });

            // Hide the total progress bar when nothing's uploading anymore
            myDropzone.on("queuecomplete", function(progress) {
              document.querySelector("#total-progress").style.opacity = "0";
            });

            myDropzone.on('success', function(file, response) {
              //console.log(response);
              foo = response;
              console.log(foo.path);
            });
            // Setup the buttons for all transfers
            // The "add files" button doesn't need to be setup because the config
            // `clickable` has already been specified.
            // document.querySelector("#actions .start").onclick = function() {
            //   myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
            // };

            // document.querySelector("#actions .cancel").onclick = function() {
            //   myDropzone.removeAllFiles(true);
            // };

    </script>
@endsection

