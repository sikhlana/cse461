@extends('html.dashboard')
@title('Dashboard')

@section('contents')
    @if ($sections->isNotEmpty())
        <item-list title="Your Sections" :count="{{ $sections->count() }}" :total="{{ $sections->count() }}">
            <template>
                @foreach ($sections as $section)
                    @component('html.components.list_item')
                        @slot('key'){{ $section->id }}@endslot
                        @slot('title'){{ $section->course->code }}: {{ $section->course->name }}@endslot
                        @slot('description')Section: {{ $section->number }}@endslot
                        @slot('actions')
                            <a href="{{ route('dashboard.section', $section) }}" class="ui mini blue labeled icon button">
                                <i class="eye icon"></i>
                                View Attendance
                            </a>
                        @endslot
                    @endcomponent
                @endforeach
            </template>
        </item-list>
    @else
        <div class="empty list">
            No courses have been appointed to you for this semester.
        </div>
    @endif
@endsection