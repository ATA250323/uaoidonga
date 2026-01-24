@extends('layouts.appespace2')

@section('template_title')
    Organisations
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('traduction.organisation') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('organisations.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th >{{ __('traduction.photo') }}</th>
                                        {{-- <th >Public Id</th> --}}
                                        <th >{{ __('traduction.titre') }}</th>
                                        <th >{{ __('traduction.description') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($organisations as $organisation)
                                        <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            <form action="{{ route('organisations.destroy', $organisation->public_id) }}" method="POST">
                                                        {{-- <a class="btn btn-sm btn-primary " href="{{ route('organisations.show', $organisation->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}
                                                <a class="btn btn-sm btn-success" href="{{ route('organisations.edit', $organisation->public_id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
                                            </form>
                                        </td>
										<td >
                                            {{-- {{ $organisation->image }} --}}
                                            <img class="img-fluid w-100" src="{{ asset('storage/' . $organisation->image) }}" class="rounded-full" width="60" height="60">
                                        </td>
										{{-- <td >{{ $organisation->public_id }}</td> --}}
										<td >{{ $organisation->titre }}</td>
                                        <td >{{ $organisation->description }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $organisations->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
