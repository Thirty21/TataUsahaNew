@extends('layout.main')

@push('script')
    <script>
        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            $('#editModal form').attr('action', '{{ route('datas.staff.index') }}/' + id);
            $('#editModal input:hidden#id').val(id);
            $('#editModal input#nip').val($(this).data('nip'));
            $('#editModal input#name').val($(this).data('name'));
            $('#editModal input#date_of_birth').val($(this).data('date_of_birth'));
            $('#editModal input#position').val($(this).data('position'));

            // Set selected gender in the select element
            const gender = $(this).data('gender');
            console.log('Gender:', gender); // Tambahkan log untuk memeriksa nilai gender

            $('#editModal select#gender').val(gender);
        });
    </script>
@endpush



@section('content')
    <x-breadcrumb
        :values="[__('menu.datas.menu'), __('menu.datas.student')]">
        <a
        {{-- . '?' . $query --}}
        href="{{ route('datas.student.print')  }}"
        target="_blank"
        class="btn btn-primary">
        {{ __('menu.general.print') }}
        </a>
        <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#createModal">
            {{ __('menu.general.create') }}
        </button>

    </x-breadcrumb>

    <div class="card mb-5">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>{{ __('model.staff.nip') }}</th>
                    <th>{{ __('model.staff.name') }}</th>
                    <th>{{ __('model.staff.date_of_birth') }}</th>
                    <th>{{ __('model.staff.gender') }}</th>
                    <th>{{ __('model.staff.position') }}</th>
                    <th>{{ __('menu.general.action') }}</th>
                </tr>
                </thead>
                @if($data)
                    <tbody>
                    @foreach($data as $staff)
                        <tr>
                            <td>{{ $staff->nip }}</td>
                            <td>{{ $staff->name }}</td>
                            <td>{{ $staff->date_of_birth }}</td>
                            <td>{{ $staff->gender }}</td>
                            <td>{{ $staff->position }}</td>
                            <td>
                                <button class="btn btn-info btn-sm btn-edit"
                                        data-id="{{ $staff->id }}"
                                        data-nip="{{ $staff->nip }}"
                                        data-name="{{ $staff->name }}"
                                        data-date_of_birth="{{ $staff->date_of_birth }}"
                                        data-gender="{{ $staff->gender }}"
                                        data-position="{{ $staff->position }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                    {{ __('menu.general.edit') }}
                                </button>
                                <form action="{{ route('datas.staff.destroy', $staff) }}" class="d-inline" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm btn-delete"
                                            type="button">{{ __('menu.general.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @else
                    <tbody>
                    <tr>
                        <td colspan="4" class="text-center">
                            {{ __('menu.general.empty') }}
                        </td>
                    </tr>
                    </tbody>
                @endif
                <tfoot class="table-border-bottom-0">
                <tr>
                    <th>{{ __('model.staff.nip') }}</th>
                    <th>{{ __('model.staff.name') }}</th>
                    <th>{{ __('model.staff.date_of_birth') }}</th>
                    <th>{{ __('model.staff.gender') }}</th>
                    <th>{{ __('model.staff.position') }}</th>
                    <th>{{ __('menu.general.action') }}</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {!! $data->appends(['search' => $search])->links() !!}

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="{{ route('datas.staff.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalTitle">{{ __('menu.general.create') }}</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <x-input-form name="nip" :label="__('model.staff.nip')"/>
                    <x-input-form name="name" :label="__('model.staff.name')"/>
                    <x-input-form name="date_of_birth" :label="__('model.staff.date_of_birth')" type="date"/>
                    <div class="form-group">
                        <label for="gender">{{ __('model.staff.gender') }}</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="Male">Laki-laki</option>
                            <option value="Female">Perempuan</option>
                        </select>
                    </div>
                    <x-input-form name="position" :label="__('model.staff.position')"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        {{ __('menu.general.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">{{ __('menu.general.save') }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalTitle">{{ __('menu.general.edit') }}</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <x-input-form name="nip" :label="__('model.staff.nip')"/>
                    <x-input-form name="name" :label="__('model.staff.name')"/>
                    <x-input-form name="date_of_birth" :label="__('model.staff.date_of_birth')" type="date"/>

                    <div class="form-group">
                        <label for="gender">{{ __('model.staff.gender') }}</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <x-input-form name="position" :label="__('model.staff.position')"/>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        {{ __('menu.general.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">{{ __('menu.general.update') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
