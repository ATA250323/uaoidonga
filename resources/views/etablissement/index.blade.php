@extends('layouts.app')

@section('template_title')
    Etablissements
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Etablissements') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('etablissements.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
									<th >Nomarabe</th>
									<th >Nomfrancais</th>
									<th >Prefixe</th>
									<th >Adresse</th>
									<th >Email</th>
									<th >Telephone</th>
									<th >Annee</th>
									<th >Centre Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($etablissements as $etablissement)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $etablissement->public_id }}</td>
										<td >{{ $etablissement->nomarabe }}</td>
										<td >{{ $etablissement->nomfrancais }}</td>
										<td >{{ $etablissement->prefixe }}</td>
										<td >{{ $etablissement->adresse }}</td>
										<td >{{ $etablissement->email }}</td>
										<td >{{ $etablissement->telephone }}</td>
										<td >{{ $etablissement->annee }}</td>
										<td >{{ $etablissement->centre_id }}</td>

                                            <td>
                                                <form action="{{ route('etablissements.destroy', $etablissement->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('etablissements.show', $etablissement->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('etablissements.edit', $etablissement->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $etablissements->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
