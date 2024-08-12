@extends('layout.master')
@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center border-bottom">
                <h4 class="card-title flex-grow-1 mb-0">{{ __('Edit Key') }}: {{ $key }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.translations.updateKey', ['lang' => $lang, 'file' => $file, 'key' => $key]) }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <textarea class="form-control" name="value" required>{{ $value }}</textarea>
                        <button class="btn btn-success" type="submit">{{ __('Save Translation') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
