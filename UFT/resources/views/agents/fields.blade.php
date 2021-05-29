<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', $member->name, ['class' => 'form-control']) !!}
</div>

<!-- Signature Field -->
<div class="form-group col-sm-6">
    {!! Form::label('signature', 'Signature:') !!}
    {!! Form::text('signature', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('agents.index') !!}" class="btn btn-default">Cancel</a>
</div>
