@extends('layouts.app')

@section('template_title')
    Centres
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Centres') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('centres.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
									<th >Nomar</th>
									<th >Nomfr</th>
									<th >Prefixe</th>
									<th >Adresse</th>
									<th >Email</th>
									<th >Telephone</th>
									<th >Anneescolaire Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($centres as $centre)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $centre->public_id }}</td>
										<td >{{ $centre->nomar }}</td>
										<td >{{ $centre->nomfr }}</td>
										<td >{{ $centre->prefixe }}</td>
										<td >{{ $centre->adresse }}</td>
										<td >{{ $centre->email }}</td>
										<td >{{ $centre->telephone }}</td>
										<td >{{ $centre->anneescolaire_id }}</td>

                                            <td>
                                                <form action="{{ route('centres.destroy', $centre->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('centres.show', $centre->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('centres.edit', $centre->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $centres->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
