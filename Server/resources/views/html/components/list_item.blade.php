<tr class="{{ $rowClass ?? null }}" id="_{{ $key }}">
    @if ($thumb ?? false)

    @endif
    <td class="title">
        {{ $title }}
        @if ($description ?? false)
            <small>{!! $description !!}</small>
        @endif
    </td>
    <td class="right aligned actions">
        @if ($actions ?? false)
            {!! $actions !!}
        @endif

        @if ($editLink ?? false)
            <a href="{{ $editLink }}" class="ui mini blue labeled icon button">
                <i class="pencil icon"></i>
                Edit
            </a>
        @endif

        @if ($deleteLink ?? false)
            <a href="{{ $deleteLink }}" class="ui mini red labeled icon button" data-delete>
                <i class="delete icon"></i>
                Delete
            </a>
        @endif
    </td>
</tr>