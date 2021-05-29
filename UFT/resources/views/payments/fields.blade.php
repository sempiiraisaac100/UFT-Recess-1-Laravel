<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Role', 'Role:') !!}
    {!! Form::text('Role', null, ['class' => 'form-control']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('payments.index') !!}" class="btn btn-default">Cancel</a>
</div>
