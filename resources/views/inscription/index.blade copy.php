@extends('layouts.appespace2')

@section('template_title')
    Inscriptions
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Inscriptions') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('inscriptions.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
									<th >{{ __('traduction.matri') }}</th>
									<th >{{ __('traduction.nom') }}</th>
									<th >{{ __('traduction.sexe') }}</th>
									<th >{{ __('traduction.nivo') }}</th>
									<th >{{ __('traduction.etabli') }}</th>
									<th >{{ __('traduction.annee') }}</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inscriptions as $inscription)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										{{-- <td >{{ $inscription->public_id }}</td> --}}
										<td >{{ $inscription->matricule }}</td>
										<td >{{ $inscription->nom }}</td>
										<td >
                                            @if ($inscription->sexe === 'm')
                                                    {{ __('traduction.sexe1') }}
                                            @else
                                                    {{ __('traduction.sexe2') }}
                                            @endif
                                        </td>
										<td >
                                            @if ($inscription->niveau === 'n1')
                                                    {{ __('traduction.niveau1') }}
                                            @else
                                                    {{ __('traduction.niveau2') }}
                                            @endif
                                        </td>
										<td >
                                            {{ app()->getLocale() == 'ar' ? $inscription->etablissement->nomarabe : $inscription->etablissement->nomfrancais }}
                                        </td>
										<td >
                                            {{ app()->getLocale() == 'ar' ? $inscription->anneescolaire->anneear : $inscription->anneescolaire->anneefr }}
                                        </td>

                                            <td>
                                                <form action="{{ route('inscriptions.destroy', $inscription->id) }}" method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('inscriptions.show', $inscription->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}
                                                    <a class="btn btn-sm btn-success" href="{{ route('inscriptions.edit', $inscription->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $inscriptions->withQueryString()->links() !!}
            </div>
        </div>
@endsection
