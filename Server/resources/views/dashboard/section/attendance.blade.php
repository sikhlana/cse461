@extends('html.dashboard')
@h1('Attendance for <em>' . e($section->course->code) . ' (Sec ' . e($section->number) . ')</em>')
@title('Attendance for ' . $section->course->code . ' (Sec ' . $section->number . ')')

@section('contents')
    <div class="ui statistics" style="justify-content: center; margin-bottom: 100px;">
        <div class="statistic">
            <div class="value">
                {{ $section->enrollments()->count() }}
            </div>
            <div class="label">
                Total Enrolled
            </div>
        </div>

        <div class="statistic">
            <div class="value">
                {{ $rate }}<sup>%</sup>
            </div>
            <div class="label">
                Attendance Rate
            </div>
        </div>
    </div>

    @if ($attendances->isNotEmpty())
        <table class="ui very basic collapsing celled table">
            <thead>
            <tr>
                <th>Students</th>
                @foreach ($attendances as $attendance)
                    <th class="center aligned">
                        Day {{ $loop->iteration }}
                        <small class="sub header">{{ $attendance['date']->format('d/m') }}</small>
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $student)
                <tr>
                    <td style="min-width: 180px">
                        <h4 class="ui image header">
                        <span class="content">
                            {{ $student->name }}
                            <span class="sub header">{{ $student->id }}</span>
                        </span>
                        </h4>
                    </td>

                    @foreach ($attendances as $attendance)
                        <td class="center aligned">
                            @if ($attendance['students']->contains('id', '=', $student->id))
                                <div class="ui tiny green label"><i class="check icon" style="margin: 0;"></i></div>
                            @else
                                <div class="ui tiny red label"><i class="times icon" style="margin: 0;"></i></div>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="empty list">
            No one enrolled for this section.
        </div>
    @endif
@endsection