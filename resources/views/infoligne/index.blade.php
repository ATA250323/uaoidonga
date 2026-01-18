@extends('layouts.app')

@section('template_title')
    Infolignes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Infolignes') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('infolignes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
									<th >Nom</th>
									<th >Email</th>
									<th >Phone</th>
									<th >Project</th>
									<th >Subjet</th>
									<th >Message</th>
									<th >Lire</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($infolignes as $infoligne)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $infoligne->public_id }}</td>
										<td >{{ $infoligne->nom }}</td>
										<td >{{ $infoligne->email }}</td>
										<td >{{ $infoligne->phone }}</td>
										<td >{{ $infoligne->project }}</td>
										<td >{{ $infoligne->subjet }}</td>
										<td >{{ $infoligne->message }}</td>
										<td >{{ $infoligne->lire }}</td>

                                            <td>
                                                <form action="{{ route('infolignes.destroy', $infoligne->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('infolignes.show', $infoligne->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('infolignes.edit', $infoligne->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $infolignes->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
