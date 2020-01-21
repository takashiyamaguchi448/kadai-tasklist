<ul class="list-unstyled">
    @foreach ($taskstasks as $taskstask)
        <li class="media mb-3">
            <div class="media-body">
                <div>
                    <p class="mb-0">{!! nl2br(e($taskstask->content)) !!}</p>
                </div>
                <div>
                    @if (Auth::id() == $taskstask->user_id)
                        {!! Form::open(['route' => ['taskstasks.destroy', $taskstask->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $taskstasks->links('pagination::bootstrap-4') }}