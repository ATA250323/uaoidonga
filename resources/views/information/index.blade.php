@extends('layouts.appespace2')
@section('content')
   <div class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-sm-12">
                    @if ($information)
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
                                      @foreach ($informations as $information)
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.histoirar') }}</h3>
                                            <p >{{ $information->histoirar }}</p>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.histoirfr') }}</h3>
                                            <p >{{ $information->histoirfr }}</p>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.raisonar') }}</h3>
                                            <p >{{ $information->raisonar }}</p>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.raisonfr') }}</h3>
                                            <p >{{ $information->raisonfr }}</p>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.inforganisaar') }}</h3>
                                                <p >{{ $information->inforganisaar }}</p>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                            <h3>{{ __('traduction.inforganisafr') }}</h3>
                                            <p >{{ $information->inforganisafr }}</p>
                                        </div>

                                                    <form action="{{ route('information.destroy',  $information->public_id) }}" method="POST">
                                                        {{-- <a class="btn btn-sm btn-primary " href="{{ route('informations.show',  $information->public_id) }}"><i class="fa fa-fw fa-eye"></i> </a> --}}
                                                        <a class="btn btn-sm btn-success" href="{{ route('information.edit',  $information->public_id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
                                                    </form>
                                    @endforeach
                                </div>
                        </div>
                    @else
                        <br>
                        <a href="{{ route('information.create') }}" class="btn btn-primary btn-sm "  data-placement="left">
                            {{ __('traduction.histoire') }} <i class="fa fa-fw fa-plus"></i>
                        </a>
                    @endif
                    {{-- {!! $informations->withQueryString()->links() !!} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
