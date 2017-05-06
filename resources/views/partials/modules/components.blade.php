@if($component_groups->isNotEmpty() || $ungrouped_components->isNotEmpty())
<div class="section-components">
    @if($component_groups->isNotEmpty())
    @foreach($component_groups as $componentGroup)
    <ul class="components-group">
        @if($componentGroup->enabled_components->isNotEmpty())
        <li class="components-group__name group-name">
            <i class="ion ion-ios-circle-filled text-component-{{ $componentGroup->lowest_status }} {{ $componentGroup->lowest_status_color }}" data-toggle="tooltip" title="{{ $componentGroup->lowest_human_status }}"></i>

            {{ $componentGroup->name }}

            <div class="pull-right">
                <i class="{{ $componentGroup->collapse_class }} group-toggle"></i>
            </div>
        </li>

        <div class="group-items {{ $componentGroup->is_collapsed ? "hide" : null }}">
            @each('partials.component', $componentGroup->enabled_components()->orderBy('order')->get(), 'component')
        </div>
        @endif
    </ul>
    @endforeach
    @endif

    @if($ungrouped_components->isNotEmpty())
    <ul class="components-group">
        <li class="components-group__name group-name">
            <i class="ion ion-ios-circle-filled text-component-{{ $ungrouped_components->max('status') }}" data-toggle="tooltip" title="{{ $ungrouped_components->sortByDesc('status')->first()->human_status }}"></i>

            {{ trans('cachet.components.group.other') }}

            <div class="pull-right">
                <i class="{{ $componentGroup->collapse_class }} group-toggle"></i>
            </div>
        </li>

        <div class="group-items">
            @each('partials.component', $ungrouped_components, 'component')
        </div>
    </ul>
    @endif
</div>
@endif