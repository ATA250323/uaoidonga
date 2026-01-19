@extends('layouts.appespace2')

@section('template_title')
    Dirigents
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('traduction.no_dirigents') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('dirigents.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
									<th >{{ __('traduction.profession') }}</th>
									{{-- <th >{{ __('traduction.facebook') }}</th> --}}
									<th >{{ __('traduction.tel') }}</th>
									{{-- <th >{{ __('traduction.tiweter') }}</th> --}}
									<th >{{ __('traduction.email') }}</th>
									<th >{{ __('traduction.photo') }}</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dirigents as $dirigent)
                                        <tr>
                                            <td>{{ ++$i }}</td>

										{{-- <td >{{ $dirigent->public_id }}</td> --}}
										<td >{{ $dirigent->nom }}</td>
										<td >{{ $dirigent->profession }}</td>
										{{-- <td >{{ $dirigent->facebook }}</td> --}}
										<td >{{ $dirigent->whatsapp }}</td>
										{{-- <td >{{ $dirigent->tiweter }}</td> --}}
										<td >{{ $dirigent->email }}</td>
										<td >
                                            <img class="img-fluid w-100" src="{{ asset('storage/' . $dirigent->image) }}" class="rounded-full" width="60" height="60">
                                        </td>

                                            <td>
                                                <form action="{{ route('dirigents.destroy', $dirigent->public_id) }}" method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('dirigents.show', $dirigent->public_id) }}"><i class="fa fa-fw fa-eye"></i></a> --}}
                                                    <a class="btn btn-sm btn-success" href="{{ route('dirigents.edit', $dirigent->public_id) }}"><i class="fa fa-fw fa-edit"></i></a>
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
                {!! $dirigents->withQueryString()->links() !!}
            </div>
        </div>
@endsection
