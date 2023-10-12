@extends('layouts.app')

@section('content')
@php
    use App\Models\group;
    use App\Models\User;
        $url = 'pip';
        $ips = request()->ip();
        $model_idu = DB::table('users')
                ->where('users.email','!=','admin@gmail.com')
                ->join('group','users.id_group','=','group.id_group')
                ->select('users.*','group.*')
                ->get();
@endphp
@can('manager')
    <div class="px-2">
        <button class="btn btn-sm btn-dark mt-2" data-bs-toggle="modal" data-bs-target="#m_add_user">
            +<i class='bx bx-user'></i>
        </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="m_add_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('create_user') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('language.new') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">{{ __('language.name') }}</span>
                            <input type="text" class="form-control" name="name_user">
                        </div>                     
                        <div class="input-group mb-3">
                            <span class="input-group-text">Email</span>
                            <input type="text" class="form-control" name="email_user">
                        </div>                     
                        <div class="input-group mb-3">
                            <span class="input-group-text">{{ __('language.gender') }}</span>
                            <select name="gender" id="" class="form-select">
                                <option value="1">{{ __('language.male') }}</option>
                                <option value="2">{{ __('language.female') }}</option>
                                <option value="3">{{ __('language.other') }}</option>
                            </select>
                        </div>                     
                        <div class="input-group mb-3">
                            <span class="input-group-text">{{ __('language.role') }}</span>
                            <select name="roles" id="" class="form-select">
                                <option value="1">{{ __('language.manager') }}</option>
                                <option value="2">{{ __('language.user') }}</option>
                            </select>
                        </div>                     
                        <div class="input-group mb-3">
                            <span class="input-group-text">{{ __('language.group') }}</span>
                            <select id="" class="form-select" name="id_group">
                                @foreach ($group as $item)
                                    <option value="{{ $item->id_group }}">{{ $item->name_group }}</option>
                                @endforeach
                            </select>
                        </div>                     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('language.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('language.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endcan

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="table-responsive rounded-3 shadow">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">{{ __('language.name') }}</th>
                            <th scope="col">Email</th>
                            <th scope="col">{{ __('language.gender') }}</th>
                            <th scope="col">{{ __('language.role') }}</th>
                            <th scope="col">{{ __('language.group') }}</th>
                            @can('manager')
                                <th scope="col">...</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            {{-- @php
                                $group_up = group::all()->where('id_group','!=',$item->id_group);
                            @endphp --}}
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $item->id_user }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if($item->gender == 1) <p>Nam</p> @elseif($item->gender == 2) <p>Nữ</p> @else <p>Khác</p> @endif
                                </td>
                                <td>@if($item->roles == 1) <p>Manager</p> @else <p>User</p> @endif</td>
                                <td>{{ $item->name_group }}</td>
                                @can('manager')
                                <td>
                                    <button class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#m_up_{{$item->id_user}}">
                                        <i class='bx bxs-edit-alt' ></i>
                                    </button>
                                    <a href="{{ route('destroy_user', ['id'=>$item->id]) }}"><i class='bx bx-x bg-danger rounded-pill text-light fs-5'></i></a>
                                </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@can('manager') 
    @foreach ($model_idu as $item)
        <!-- Modal -->
        <div class="modal fade" id="m_up_{{$item->id_user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 1 00;">
            <div class="modal-dialog">
                <form action="{{ route('update_user') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('language.update') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text">{{ __('language.name') }}</span>
                                <input type="text" class="form-control" name="name_user_up" value="{{ $item->name }}">
                            </div>   
                            <input type="hidden" name="id_up" value="{{ $item->id }}">               
                            <div class="input-group mb-3">
                                <span class="input-group-text">Email</span>
                                <input type="text" class="form-control" name="email_user_up" value="{{ $item->email }}">
                            </div>    
                            <div class="input-group mb-3">
                                <span class="input-group-text">{{ __('language.role') }}</span>
                                <select name="roles_up" id="" class="form-select">
                                    <option value="{{ $item->roles }}" selected>
                                        @if ($item->roles == 1){{ __('language.manager') }} @else {{ __('language.user') }} @endif
                                    </option>
                                    <option value="1">{{ __('language.manager') }}</option>
                                    <option value="2">{{ __('language.user') }}</option>
                                </select>
                            </div>                     
                            <div class="input-group mb-3">
                                <span class="input-group-text">{{ __('language.group') }}</span>
                                <select id="" class="form-select" name="id_group_up">
                                    <option value="{{ $item->id_group }}" selected>{{ $item->name_group }}</option>
                                    @foreach ($group as $item_gr)
                                        <option value="{{ $item_gr->id_group }}">{{ $item_gr->name_group }}</option>
                                    @endforeach
                                </select>
                            </div>                
                            <div class="input-group mb-3">
                                <span class="input-group-text">{{ __('language.gender') }}</span>
                                <select name="gender_up" id="" class="form-select">
                                    <option value="{{ $item->gender }}" selected>
                                        @if ($item->gender == 1) {{ __('language.male') }} @elseif($item->gender == 2) {{ __('language.female') }} @else {{ __('language.other') }} @endif
                                    </option>
                                    <option value="1">{{ __('language.male') }}</option>
                                    <option value="2">{{ __('language.female') }}</option>
                                    <option value="3">{{ __('language.other') }}</option>
                                </select>
                            </div>    
                                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('language.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('language.save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endcan

{{-- <script>
    const myModal = document.getElementById('m_add_user')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
    myInput.focus()
    })
</script> --}}
@endsection
