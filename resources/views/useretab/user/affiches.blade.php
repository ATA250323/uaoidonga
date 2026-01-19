@extends('layouts.appespace2')
@section('content')
 <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
            <div class="col-md-12">
                {{-- @if (@session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif --}}

                <br><br>
                @if($users)
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-0 pb-0">
                            <h3 class=" ">
                                {{ __('traduction.lesmembr') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

                                <a href="{{ route('etabusers.create',$public_id) }}" class="btn btn-info float-end">
                                    <i class="fa fa-fw fa-plus"></i>
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                {{-- <th>Établissement</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            {{ $role->name }}
                                        @endforeach
                                    </td>
                                    {{-- <td>{{ $user->etablissement->nomarabe }}</td> --}}
                                    <td>
                                           <form action="{{ route('etabusers.destroy', [$public_id,$user->id]) }}" method="POST">
                                            <a href="{{ route('etabusers.edit', [$public_id,$user->public_id]) }}"
                                                class="btn btn-primary btn-sm  ms-1 "><i class="fa fa-fw fa-edit"></i></a>
                                            @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Êtes-vous sûr de vouloir supprimer cette personne?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
                                            </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                @else
                    <div class="">
                    <a href="{{ route('etabusers.create',$public_id) }}" class="btn btn-primary btn-sm">
                                {{ __('traduction.ajoumembre') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                    </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
 <!-- [ Main Content ] end -->
@endsection
