@extends('base')

@section('title', 'Home')

@section('content')

<style type="text/css">

</style>

    <div class="row mt-4 mb-4">
        <div class="col-sm-8 h3">Task</div>
        <div class="col-sm-2 h3 text-center">Due</div>
        <div class="col-sm-2 h3 text-center">Completed</div>
    </div>
	
	@foreach($tasks as $task)

		<div class="row">
			<div class="col-sm-8">
				<div><a href="{{ route('task.edit', $task->id) }}" class="">{{ $task->name }}</a></div>
				<div><small>{{ $task->description }}</small></div>
            </div>
            <div class="col-sm-2 text-center">{{ \Carbon\Carbon::parse($task->target_completion_date)->format('M jS, Y')}}</div>

            <div class="col-sm-2 text-center completion-date-{{ $task->id }}">
                @if ($task->completion_date == null)
                    <a href="" class="complete-task btn btn-block btn-success" data-id="{{ $task->id }}">Complete</a>
                @else
                    {{ \Carbon\Carbon::parse($task->completion_date)->format('M jS, Y') }}
                @endif
            </div>
            
		</div>
		<hr>
	
	@endforeach

	<div class="row justify-content-center">
		<div class="col-sm-6 text-center">
			{{ $tasks->links() }}
		</div>
	</div>

@endsection

@section('scripts')

<script type="text/javascript">
    $(function () {
        $('.complete-task').on('click', completeTask)
    });

    function completeTask(event){
        event.preventDefault()

        //console.log('complete-task');

        let id = $(this).data('id')
        let today = '{{ \Carbon\Carbon::now()->format('M jS, Y') }}'; //use blade instead of js library

        fetch('/task/complete/'+id)
        .then((resp) => resp.json())
        .then(function(data) {
            $('.completion-date-'+id).html(today)
        })
        .catch(function(error) {
            console.log(JSON.stringify(error))
        });

        return false;
    }
</script>

@endsection