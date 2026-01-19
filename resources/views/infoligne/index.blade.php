@extends('layouts.appespace2')

@section('template_title')
    Infolignes
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('traduction.suggestion') }}
                            </span>
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
									<th >{{ __('traduction.email') }}</th>
									<th >{{ __('traduction.subjet') }}</th>
									<th >{{ __('traduction.messages') }}</th>
									<th >{{ __('traduction.lire') }}</th>
									<th >{{ __('traduction.date') }}</th>

                                        <th>{{ __('traduction.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($infolignes as $infoligne)
                                        <tr>
                                            <td>{{ ++$i }}</td>

										{{-- <td >{{ $infoligne->public_id }}</td> --}}
										<td >{{ $infoligne->nom }}</td>
										<td >{{ $infoligne->email }}</td>
										<td >{{ $infoligne->subjet }}</td>
										<td >{{ $infoligne->message }}</td>
										<td >{{ $infoligne->lire }}</td>
										<td >{{ $infoligne->created_at }}</td>

                                            <td>
                                                <form action="{{ route('infolignes.destroy', $infoligne->public_id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('infolignes.show', $infoligne->public_id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('infolignes.edit', $infoligne->public_id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
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
@endsection
