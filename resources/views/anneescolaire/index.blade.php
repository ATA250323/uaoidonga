@extends('layouts.appespace2')

@section('template_title')
    Anneescolaires
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Anneescolaires') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('anneescolaires.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
									<th >{{ __('traduction.anneefr') }}</th>
									<th >{{ __('traduction.anneear') }}</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anneescolaires as $anneescolaire)
                                        <tr>
                                            <td>{{ ++$i }}</td>

										{{-- <td >{{ $anneescolaire->public_id }}</td> --}}
										<td >{{ $anneescolaire->anneefr }}</td>
										<td >{{ $anneescolaire->anneear }}</td>

                                            <td>
                                                <form action="{{ route('anneescolaires.destroy', $anneescolaire->id) }}" method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('anneescolaires.show', $anneescolaire->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}
                                                    <a class="btn btn-sm btn-success" href="{{ route('anneescolaires.edit', $anneescolaire->public_id) }}"><i class="fa fa-fw fa-edit"></i></a>
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
                {!! $anneescolaires->withQueryString()->links() !!}
            </div>
        </div>
    </div>
    </div>
@endsection
