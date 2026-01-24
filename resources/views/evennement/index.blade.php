@extends('layouts.appespace2')

@section('template_title')
    Evennements
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
                                {{ __('traduction.evennement') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('evennements.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
									{{-- <th >{{ __('traduction.evennement') }}</th> --}}
									<th >{{ __('traduction.titre') }}</th>
									<th >{{ __('traduction.organisation') }}</th>
									<th >{{ __('traduction.annee') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($evennements as $evennement)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                <form action="{{ route('evennements.destroy', $evennement->public_id) }}" method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('evennements.show', $evennement->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}
                                                    <a class="btn btn-sm btn-success" href="{{ route('evennements.edit', $evennement->public_id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                            <td >
                                            <img class="img-fluid w-100" src="{{ asset('storage/' . $evennement->image) }}" class="rounded-full" width="60" height="60">
                                            </td>
                                            {{-- <td >{{ $evennement->public_id }}</td> --}}
                                            {{-- <td >{{ $evennement->titrear }}</td> --}}
                                            <td >{{ $evennement->titrear }}</td>
                                            <td >{{ $evennement->organisation->titre }}</td>
                                            <td >{{ $evennement->anneescolaire->anneear.' / '.$evennement->anneescolaire->anneefr }}</td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $evennements->withQueryString()->links() !!}
            </div>
        </div>
    </div>
    </div>
@endsection
