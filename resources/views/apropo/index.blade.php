@extends('layouts.appespace2')

@section('template_title')
    Apropos
@endsection

@section('content')
   <div class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-sm-12">
                    @if ($apropo)
                        <div class="card">
                                <div class="card-header">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">

                                        <span id="card_title">
                                            {{ __('traduction.uaoidonga2') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body bg-white">
                                    <div class="row">
                                        <div class="grid grid-cols-12 gap-3 mb-3">

                                      @foreach ($apropos as $apropo)
                                        <div class="col-span-12 xl:col-span-12 md:col-span-12">
                                            <h3>{{ __('traduction.anneecrer') }}</h3>
                                            <p >{{ $apropo->annee }}</p>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.apropos') }}</h3>
                                            <p >{{ $apropo->aproposar }}</p>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.aproposfr') }}</h3>
                                            <p >{{ $apropo->aproposfr }}</p>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.missionar') }}</h3>
                                            <p >{{ $apropo->missionar }}</p>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.missionfr') }}</h3>
                                            <p >{{ $apropo->missionfr }}</p>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.objectifar') }}</h3>
                                                <p >{{ $apropo->objectifar }}</p>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.objectiffr') }}</h3>
                                            <p >{{ $apropo->objectiffr }}</p>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.visionar') }}</h3>
                                            <p >{{ $apropo->visionar }}</p>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.visionfr') }}</h3>
                                            <p >{{ $apropo->visionar }}</p>
                                        </div>

                                                    <form action="{{ route('apropos.destroy',  $apropo->public_id) }}" method="POST">
                                                        {{-- <a class="btn btn-sm btn-primary " href="{{ route('apropos.show',  $apropo->public_id) }}"><i class="fa fa-fw fa-eye"></i> </a> --}}
                                                        <a class="btn btn-sm btn-success" href="{{ route('apropos.edit',  $apropo->public_id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
                                                    </form>
                                    @endforeach
                                </div>
                        </div>
                    @else
                        <br>
                        <a href="{{ route('apropos.create') }}" class="btn btn-primary btn-sm "  data-placement="left">
                            {{ __('traduction.apropos') }} <i class="fa fa-fw fa-plus"></i>
                        </a>
                    @endif
                    {{-- {!! $apropos->withQueryString()->links() !!} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
