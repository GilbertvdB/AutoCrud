    

    @section('content')
    <div class="container">
        <h1>Create {{ $model }}</h1>
    
        <form method="POST" action="{{ route($model . 's.store') }}">
            @csrf
            @foreach ($fillableProperties as $property)
            @php
                $inputType = $inputTypes[$property] ?? 'text';
            @endphp

            @if ($inputType !== 'none')
                <div class="form-group">
                    <label for="{{ $property }}">{{ ucwords(str_replace('_', ' ', $property)) }}</label>

                    @if ($inputType === 'textarea')
                        <textarea name="{{ $property }}" id="{{ $property }}" class="form-control" required></textarea>
                    @elseif ($inputType === 'select')
                        <select name="{{ $property }}" id="{{ $property }}" class="form-control" required>
                            <option value="">Select an option</option>
                            <!-- Add options here -->
                        </select>
                    @else
                        <input type="{{ $inputType }}" name="{{ $property }}" id="{{ $property }}" class="form-control" value="{{ old($property) }}" required>
                    @endif
                </div>
            @endif
        @endforeach
    
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
    @endsection