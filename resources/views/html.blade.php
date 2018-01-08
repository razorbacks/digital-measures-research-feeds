@foreach ($publications as $publication)
    <div class="panel panel-default">
        <div class="panel-body">
            @foreach ($publication->INTELLCONT_AUTH as $author)
                {{ $author->FNAME }} {{ $author->LNAME }},
            @endforeach
            ({{ !empty((string)$publication->DTY_PUB) ? $publication->DTY_PUB : 'in press' }}).
            {{ $publication->TITLE }}
            <i>{{ $publication->PUBLISHER_LIST }}</i>,
            <i>{{ $publication->PUBLISHER }}</i>
            {{ $publication->VOLUME }}
            {{ !empty((string)$publication->ISSUE) ? "({$publication->ISSUE})" : '' }}
            {{ !empty((string)$publication->PAGENUM) ? ": {$publication->PAGENUM}" : '' }}
        </div>
    </div>
@endforeach
