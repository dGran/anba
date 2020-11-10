<li @if(isset($item['id'])) id="{{ $item['id'] }}" @endif class="nav-item">

    <a class="nav-link {{ $item['class'] }} d-flex align-items-center @if(isset($item['shift'])) {{ $item['shift'] }} @endif"
       href="{{ $item['href'] }}" @if(isset($item['target'])) target="{{ $item['target'] }}" @endif
       {!! $item['data-compiled'] ?? '' !!} style="line-height: 1.1em; padding-top: .7em; padding-bottom: .7em">

        <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{
            isset($item['icon_color']) ? 'text-'.$item['icon_color'] : ''
        }} text-center" style="width: 24px; font-size: 1.1em; margin-right: .3em"></i>

        <p>
            {{ $item['text'] }}

            @if(isset($item['label']))
                <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                    {{ $item['label'] }}
                </span>
            @endif
        </p>

    </a>

</li>