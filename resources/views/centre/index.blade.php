@extends('layouts.appespace2')

@section('template_title')
    Centres
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('traduction.centre') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('centres.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>{{ __('traduction.action') }}</th>

									{{-- <th >Public Id</th> --}}
									{{-- <th >{{ __('traduction.nomctar') }}</th> --}}
									<th >{{ __('traduction.centre_id') }}</th>
									<th >{{ __('traduction.prefixect') }}</th>
									<th >{{ __('traduction.ville') }}</th>
									{{-- <th >{{ __('traduction.email') }}</th>
									<th >{{ __('traduction.tel') }}</th> --}}
									<th >{{ __('traduction.annee') }}</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($centres as $centre)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                <form action="{{ route('centres.destroy', $centre->public_id) }}" method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('centres.show', $centre->public_id) }}"><i class="fa fa-fw fa-eye"></i></a> --}}
                                                    <a class="btn btn-sm btn-success" href="{{ route('centres.edit', $centre->public_id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> </button>
                                                </form>
                                            </td>

										{{-- <td >{{ $centre->public_id }}</td> --}}
										{{-- <td >{{ $centre->nomar }}</td> --}}
										<td >
                                            {{ $centre->nomar.' '.$centre->nomfr}}
                                            {{-- {{ app()->getLocale() == 'ar' ? $centre->nomar : $centre->nomfr }} --}}
                                        </td>
										<td >{{ $centre->prefixe }}</td>
										<td >{{ $centre->adresse }}</td>
										{{-- <td >{{ $centre->email }}</td>
										<td >{{ $centre->telephone }}</td> --}}
										<td >{{ $centre->anneescolaire->anneear.'-'.$centre->anneescolaire->anneefr}}</td>
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
@endsection
