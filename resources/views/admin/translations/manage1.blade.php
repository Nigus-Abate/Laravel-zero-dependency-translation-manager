@extends('layout.master')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center border-bottom">
                <h4 class="card-title flex-grow-1 mb-0">{{ __('Manage Translations') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('translations.update', $lang) }}" method="POST">
                    @csrf
                    @foreach($translations as $file => $data)
                        <h3 class="text-muted">{{ $file }}</h3>
                        <hr>
                        @foreach($data as $key => $value)
                            @if(is_array($value))
                                @foreach($value as $subKey => $subValue)
                                    @if(is_array($subValue))
                                        @include('super-admin.translations.partials.translation-input', [
                                            'name' => "{$key}[{$subKey}]",
                                            'value' => $subValue,
                                            'lang' => $lang,
                                            'file' => $file
                                        ])
                                    @else
                                        <div class="row mb-2">
                                            <div class="col-md-10">
                                                <strong>{{ "{$key}.{$subKey}" }}</strong>
                                            </div>
                                            <div class="col-md-2 text-end">
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editKeyModal" data-lang="{{ $lang }}" data-file="{{ $file }}" data-key="{{ "{$key}.{$subKey}" }}" data-value="{{ $subValue }}">
                                                    {{ __('Edit') }}
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="row mb-2">
                                    <div class="col-md-10">
                                        <strong>{{ $key }}</strong>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editKeyModal" data-lang="{{ $lang }}" data-file="{{ $file }}" data-key="{{ $key }}" data-value="{{ $value }}">
                                            {{ __('Edit') }}
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                    <button class="btn btn-secondary" type="submit">{{ __('Save Translations') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Key Modal -->
<div class="modal fade" id="editKeyModal" tabindex="-1" aria-labelledby="editKeyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKeyModalLabel">{{ __('Edit Key') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editKeyForm" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="modalKey" class="form-label">{{ __('Key') }}</label>
                        <input type="text" class="form-control" id="modalKey" name="key" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="modalValue" class="form-label">{{ __('Value') }}</label>
                        <textarea class="form-control" id="modalValue" name="value" rows="3"></textarea>
                    </div>
                    <input type="hidden" id="modalLang" name="lang">
                    <input type="hidden" id="modalFile" name="file">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var editKeyModal = document.getElementById('editKeyModal');
    editKeyModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var lang = button.getAttribute('data-lang');
        var file = button.getAttribute('data-file');
        var key = button.getAttribute('data-key');
        var value = button.getAttribute('data-value');

        var modalLangInput = editKeyModal.querySelector('#modalLang');
        var modalFileInput = editKeyModal.querySelector('#modalFile');
        var modalKeyInput = editKeyModal.querySelector('#modalKey');
        var modalValueTextarea = editKeyModal.querySelector('#modalValue');

        modalLangInput.value = lang;
        modalFileInput.value = file;
        modalKeyInput.value = key;
        modalValueTextarea.value = value;

        var form = editKeyModal.querySelector('#editKeyForm');
        form.action = '{{ $base_url}}/super-admin/translations/updateKey/' + lang + '/' + file + '/' + encodeURIComponent(key);
    });
});
</script>

@endsection