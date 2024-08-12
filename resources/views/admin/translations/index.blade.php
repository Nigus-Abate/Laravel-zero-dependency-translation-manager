@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
         <div class="card-header d-flex align-items-center border-bottom">
            <h4 class="card-title flex-grow-1 mb-0">{{ __('Manage Translations') }}</h4>
            <div class="d-flex gap-1 flex-wrap">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewLanguage">
                    {{ __('Add New Language') }}
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Language') }}</th>
                            <th class="text-end">{{ __('Manage') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($languages as $language)
                        <tr>
                            <td>
                                <a href="{{ route('admin.translations.edit', $language) }}">{{ $language }}</a>
                            </td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton-{{ $loop->index }}" data-toggle="dropdown" aria-expanded="false">
                                        {{ __('Actions') }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $loop->index }}">
                                        <li><a class="dropdown-item" href="{{ route('admin.translations.edit', $language) }}">{{ __('Edit') }} {{ $language }}</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $loop->index }}').submit();">{{ __('Delete') }}</a></li>
                                        {{--  <form id="delete-form-{{ $loop->index }}" action="{{ route('admin.translations.destroy', $language) }}" method="POST" style="display: none;">--}}
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Add New Language Modal -->
<div class="modal fade" id="addNewLanguage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fs-5">{{ __('Add New Language') }}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span class="mdi mdi-close"></span></button>
            </div>
            <div class="modal-body">


                <form action="{{ route('admin.translations.copy') }}" method="POST" id="addNewLanguages">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="lang" placeholder="New locale (e.g., es)" class="form-control bg-light border-dark" required>
                        <input type="text" name="flag_icon" placeholder="flag icon ex.fi fi-us" class="form-control bg-light border-dark" required>
                        <button type="submit" class="btn btn-sm btn-dark" id="add_new_language">
                            <i class="ri-add-line align-bottom"></i> {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection