@if(is_array($value))
    @foreach($value as $subKey => $subValue)
        @if(is_array($subValue))
            @include('admin.translations.partials.translation-input', ['name' => "{$name}[{$subKey}]", 'value' => $subValue, 'lang' => $lang, 'file' => $file])
        @else
            <form action="{{ route('admin.translations.updateKey', ['lang' => $lang, 'file' => $file, 'key' => $key]) }}" method="POST">
        @csrf
            <div class="input-group">
                <div class="col-sm-4">
                <label class="form-label">{{ "{$name}.{$subKey}" }}</label>
            </div>
            <!-- <input class="form-control" type="text" name="value" value="{{ $subValue }}">
            <button class="btn btn-dark" type="submit">Save Translation</button> -->

                <input type="text" class="form-control" name="{{ "{$name}[{$subKey}]" }}" value="{{ $subValue }}">
                <a class="btn btn-md btn-dark" href="{{ route('admin.translations.editKey', ['lang' => $lang, 'file' => $file, 'key' => "{$name}.{$subKey}"]) }}">Edit Key</a>
            </div><br>
        </form>
        @endif
    @endforeach
@else
    <form action="{{ route('admin.translations.updateKey', ['lang' => $lang, 'file' => $file, 'key' => $key]) }}" method="POST">
        @csrf
    <div class="input-group">
         <div class="col-sm-4">
        <label class="form-label">{{ $name }}</label>
    </div>
     <!-- <input class="form-control" type="text" name="value" value="{{ $value }}">
    <button class="btn btn-dark" type="submit">Save Translation</button> -->

        <input type="text" class="form-control" name="{{ $name }}" value="{{ $value }}">
        <a class="btn btn-dark" href="{{ route('admin.translations.editKey', ['lang' => $lang, 'file' => $file, 'key' => $name]) }}">Edit Key</a>
    </div><br></form>
@endif
