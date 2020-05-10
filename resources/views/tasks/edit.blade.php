@extends('base')

@section('title', 'Edit Task')

@section('content')

<style type="text/css">
.delete-button {
	float: right; 
	width: 100px;
	margin-left: 12px; 
	margin-bottom:  12px;
}
</style>

	<div class="row">
		<div class="col-sm-12">
			<div class="mb-5">
				<h1 class="d-inline">Edit Task</h1>
				
				{!! Form::open(['route' => ['task.destroy', $task->id], 'method' => 'DELETE', 'class' => 'delete-button']) !!}
					<button class="btn btn-block btn-danger" type="submit">Delete</button>
				{!! Form::close() !!}
			</div>
			{!! Form::model($task, ['route' => ['task.update', $task->id], 'method' => 'PUT']) !!}
				@component('components.taskForm')
				@endcomponent
			{!! Form::close() !!}
		</div>
	</div>

@endsection