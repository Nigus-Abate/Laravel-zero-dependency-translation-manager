@extends('layout.master')
@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
                <div class="card-header d-flex align-items-center border-bottom">
                    <h4 class="card-title flex-grow-1 mb-0">Edit Translations for {{ $lang }}</h4>
                    <div class="d-flex gap-1 flex-wrap">
                        <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i
                            class="ri-delete-bin-2-line"></i></button>
                        <button type="button" class="btn btn-primary btn-sm create-btn"><i class="ri-add-line align-bottom me-1"></i> Add New missing Key</button>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card mb-3">
                           <div class="card-body">
                            <form action="{{ route('admin.translations.update', $lang) }}" method="POST">
                                @csrf
                                @foreach($translations as $file => $data)
                                <h3 class="text-muted">{{ $file }}</h3><hr>
                                @foreach($data as $key => $value)
                                @include('admin.translations.partials.translation-input', ['name' => $key, 'value' => $value, 'lang' => $lang, 'file' => $file])
                                @endforeach
                                @endforeach
                                <button class="btn btn-secondary" type="submit">Save Translations</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection

