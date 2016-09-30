<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 4/15/16
 * Time: 9:02 PM
 */

?>

<form action="{!! action('ImageController@store',['task'=>$id->id]) !!}"
      class="dropzone"
      id="my-awesome-dropzone" file="'1">
    <div class="form-group">
        <label for="type">Select Upload Image Type</label>
        <select name="type" id="type" class="form-control">
            <option value="Original">Original Image</option>
            <option value="Done">Completed Image</option>
        </select>
    </div>
</form>


@section('footer_script')
    @parent
    <script src="{!! asset('js/dropzone.js') !!}"></script>
    <script>
        // "myAwesomeDropzone" is the camelized version of the HTML element's ID
        Dropzone.options.myAwesomeDropzone = {
            paramName: "image", // The name that will be used to transfer the file
            maxFilesize: 2, // MB,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        };
    </script>
@endsection