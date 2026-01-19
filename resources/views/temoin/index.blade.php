@extends('layouts.appespace2')

@section('template_title')
    Temoins
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('traduction.temoi') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('temoins.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  <i class="fa fa-fw fa-plus"></i>
                                </a>
                              </div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>{{ __('traduction.num') }}</th>

									{{-- <th >Public Id</th> --}}
									<th >{{ __('traduction.nom') }}</th>
									<th >{{ __('traduction.messages') }}</th>
									{{-- <th >Messagefr</th> --}}
									<th >{{ __('traduction.organisation') }}</th>
									<th >{{ __('traduction.statut') }}</th>
									<th >{{ __('traduction.photo') }}</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($temoins as $temoin)
                                        <tr>
                                            <td>{{ ++$i }}</td>

										{{-- <td >{{ $temoin->public_id }}</td> --}}
										<td >{{ $temoin->nom_prenom }}</td>
										<td >
                                            {{ app()->getLocale() == 'ar' ? $temoin->messagear : $temoin->messagefr }}
                                        </td>
										{{-- <td >{{ $temoin->messagefr }}</td> --}}
										<td >{{ $temoin->nom_organe }}</td>
										<td >
                                            <form action="{{ route('temoins.status', $temoin->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <div class="form-check form-switch">
                                                    <input 
                                                        class="form-check-input" 
                                                        type="checkbox" 
                                                        onchange="this.form.submit()"
                                                        {{ $temoin->status ? 'checked' : '' }}>
                                                </div>
                                            </form>
                                        </td>
										<td >
                                            <img class="img-fluid w-100" src="{{ asset('storage/' . $temoin->image) }}" class="rounded-full" width="60" height="60">
                                        </td>

                                            <td>
                                                <form action="{{ route('temoins.destroy', $temoin->public_id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('temoins.show', $temoin->public_id) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                                    {{-- <a class="btn btn-sm btn-success" href="{{ route('temoins.edit', $temoin->public_id) }}"><i class="fa fa-fw fa-edit"></i></a> --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $temoins->withQueryString()->links() !!}
            </div>
        </div>
@endsection
