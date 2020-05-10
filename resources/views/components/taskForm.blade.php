{{ Form::label('name', 'Task Name', ['class' => 'control-label']) }}
{{ Form::text('name', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'Task Name']) }}

{{ Form::label('description', 'Description', ['class' => 'control-label mt-3']) }}
{{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) }}

{{ Form::label('target_completion_date', 'Target Completion Date', ['class' => 'control-label mt-3']) }}
{{ Form::date('target_completion_date', null, ['class' => 'form-control']) }}

{{ Form::label('completion_date', 'Completion Date', ['class' => 'control-label mt-3']) }}
{{ Form::date('completion_date', null, ['class' => 'form-control']) }}

<div class="row mt-5">
	<div class="col-sm-3">
		<button class="btn btn-block btn-primary" type="submit">Save</button>
    </div>
</div>