<aside class="d-flex flex-column flex-shrink-0 text-white bg-dark position-relative" style="width: 280px;">
    <div class="border-bottom p-2 text-start">
        <img src="{{ config('varenyky-admin.logo') }}" height="50">
    </div>
    <div class="p-2 mt-3">
        <ul class="list-unstyled">
            @foreach (config('project.sidebar') as $item)
                <li>
                    <a href="{{ $item['link'] }}" @if(request()->path() == $item['link'] || Str::contains(request()->path(), $item['link'])) class="active" @endif>
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="{{ $item['icon'] }}"></i>
                            </div>
                            <div class="col-6 text-start">
                                {{ $item['name'] }}
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="border-top p-2 py-3 text-start footer">
        <div class="row">
            @foreach (config('project.footer') as $item)
                <div class="col text-center">
                    <a href="{{ $item['link'] }}">
                        <i class="{{ $item['icon'] }}"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</aside>