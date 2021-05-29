{!! Form::open(['route' => ['members.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('members.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('members.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-plus"></i>
    </a>
</div>
{!! Form::close() !!}
