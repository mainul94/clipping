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
    <td>{!! $task->total_amount !!}</td>
    <td>{!! $task->task_type !!}</td>
    <td>No Data</td>
    <td>{!! Html::taskStatusLabel($task->status) !!}</td>
    <td>
        @permission("update.task")
            <a href="{{ action('TaskController@edit',$task->id) }}"><i class="fa fa-pencil-square-o"></i></a>
        @endpermission
        @permission("delete.task")
            {!! Html::delete('TaskController@destroy',$task->id) !!}
        @endpermission
    </td>
</tr>
