<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/27/16
 * Time: 11:20 AM
 */
?>
<div class="col-xs-12">
    <label>Permissions:</label>
</div>
<div class="row">
    <div class="col-xs-12">
        <button id="check_all_permission" type="button" class="btn btn-sm">Check ALL</button>
        <button id="uncheck_all_permission" type="button" class="btn btn-sm">Uncheck ALL</button>
    </div>
    @foreach($permissions as $permission)
        <div class="col-sm-4 col-md-3">
            {!! Form::checkbox('permission_id[]',$permission->id, null, ['class'=>'flat']) !!} {!! $permission->name !!}
        </div>
    @endforeach
</div>
<div class="clearfix"></div>

@section('head')
    <!-- iCheck -->
    <link href="{!! url('vendors/iCheck/skins/flat/green.css') !!}" rel="stylesheet">
@endsection

@section('footer_script')
    @parent
    <!-- iCheck -->
    <script src="{!! asset('vendors/iCheck/icheck.min.js') !!}"></script>
@endsection

@section('script_call')
    <script>
        $('#check_all_permission').on('click',function () {
            $('input[name^="permission_id"]').prop("checked", true);
            $('[class^="icheckbox_flat"]').addClass('checked');
        });
        $('#uncheck_all_permission').on('click',function () {
            $('input[name^="permission_id"]').prop("checked",false);
            $('[class^="icheckbox_flat"]').removeClass('checked');
        });
    </script>
@endsection
