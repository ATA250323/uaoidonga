@extends('layouts.app')

@section('template_title')
    User Etablissements
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('User Etablissements') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('user-etablissements.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Public Id</th>
									<th >User Id</th>
									<th >Etablissement Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userEtablissements as $userEtablissement)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $userEtablissement->public_id }}</td>
										<td >{{ $userEtablissement->user_id }}</td>
										<td >{{ $userEtablissement->etablissement_id }}</td>

                                            <td>
                                                <form action="{{ route('user-etablissements.destroy', $userEtablissement->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('user-etablissements.show', $userEtablissement->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('user-etablissements.edit', $userEtablissement->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $userEtablissements->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
