@extends('layout.master')
@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center border-bottom">
                <h4 class="card-title flex-grow-1 mb-0">{{ __('Edit Translations for') }} {{ $lang }}</h4>
                <div class="d-flex gap-1 flex-wrap">
                    <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()">
                        <i class="ri-delete-bin-2-line"></i>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm create-btn" data-toggle="modal" data-target="#addMissingKey">
                        <i class="ri-add-line align-bottom me-1"></i> {{ __('Add New Missing Key') }}
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.translations.update', $lang) }}" method="POST">
                    @csrf
                    @foreach($translations as $file => $data)
                        <h3 class="text-muted">{{ $file }}</h3>
                        <hr>
                        @if(is_array($data))
                            @foreach($data as $key => $value)
                                @include('admin.translations.partials.translation-input', [
                                    'name' => $key,
                                    'value' => $value,
                                    'lang' => $lang,
                                    'file' => $file
                                ])
                            @endforeach
                        @else
                            <p>{{ __('Unsupported file format.') }}</p>
                        @endif
                    @endforeach
                    <button class="btn btn-secondary" type="submit">{{ __('Save Translations') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Missing Key Modal -->
<div class="modal fade" id="addMissingKey">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fs-5">{{ __('Add New Missing Key') }}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span class="mdi mdi-close"></span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.translations.addKey', $lang) }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="key" placeholder="Key" class="form-control bg-light border-dark" required>
                        <input type="text" name="value" placeholder="Value" class="form-control bg-light border-dark" required>
                        <button type="submit" class="btn btn-sm btn-dark" id="add_new_key">
                            <i class="ri-add-line align-bottom"></i> {{ __('Add Key') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
