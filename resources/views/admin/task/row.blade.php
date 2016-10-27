<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 3/11/16
 * Time: 2:11 AM
 */
?>

<tr>
    <td>{!! $task->id !!}</td>
    <td>{!! $task->title !!}</td>
    <td>{!! $task->total_qty !!}</td>
    @permission("priceview.task")
    <td>{!! $task->total_amount !!}</td>
    @endpermission
    <td>{!! $task->task_type !!}</td>
    <td>
        @if(in_array($task->status, ['Rejected', 'Completed', 'Finished']))
            {!! $task->delivery !!}
        @else
            @if($task->delivery->diffInMinutes() <= 240 )
                <strong class="text-danger">{!! $task->delivery !!}</strong>
                @else
                <strong class="text-success">{!! $task->delivery !!}</strong>
            @endif
        @endif
    </td>
    <td>{!! Html::taskStatusLabel($task->status) !!}</td>
    <td>
        @permission("view.task")
            <a href="{{ action('TaskController@show',$task->id) }}"><i class="fa fa-eye"></i></a>
        @endpermission
        @permission("update.task")
            <a href="{{ action('TaskController@edit',$task->id) }}"><i class="fa fa-pencil-square-o"></i></a>
        @endpermission
        @permission("delete.task")
            {!! Html::delete('TaskController@destroy',$task->id) !!}
        @endpermission
    </td>
</tr>
