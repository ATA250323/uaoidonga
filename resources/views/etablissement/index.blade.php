@extends('layouts.appespace2')

@section('template_title')
    Etablissements
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('traduction.etablis') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('etablissements.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>{{ __('traduction.action') }}</th>
                                        <th>{{ __('traduction.num') }}</th>
                                        
									{{-- <th >Public Id</th> --}}
									{{-- <th >{{ __('traduction.nomarabe') }}</th> --}}
									<th >{{ __('traduction.etablis') }}</th>
									<th >{{ __('traduction.prefixeet') }}</th>
									<th >{{ __('traduction.adresse') }}</th>
									<th >{{ __('traduction.email') }}</th>
									<th >{{ __('traduction.tel') }}</th>
									<th >{{ __('traduction.annee') }}</th>
									<th >{{ __('traduction.centre_id') }} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($etablissements as $etablissement)
                                        <tr>
                                            <td>
                                                <form action="{{ route('etablissements.destroy', $etablissement->public_id) }}" method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('etablissements.show', $etablissement->public_id) }}"><i class="fa fa-fw fa-eye"></i></a> --}}
                                                    <a class="btn btn-sm btn-success" href="{{ route('etablissements.edit', $etablissement->public_id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> </button>
                                                </form>
                                            </td>
                                            <td>{{ ++$i }}</td>
                                            
										{{-- <td >{{ $etablissement->public_id }}</td> --}}
										{{-- <td >{{ $etablissement->nomarabe }}</td> --}}
										<td >
                                            {{ app()->getLocale() == 'ar' ? $etablissement->nomarabe : $etablissement->nomfrancais }}
                                        </td>
										<td >{{ $etablissement->prefixe }}</td>
										<td >{{ $etablissement->adresse }}</td>
										<td >{{ $etablissement->email }}</td>
										<td >{{ $etablissement->telephone }}</td>
										<td >{{ $etablissement->anneescolaire->anneear.' '.$etablissement->anneescolaire->anneefr }}</td>
										<td >{{ $etablissement->centre->nomar }}</td>
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
@endsection
