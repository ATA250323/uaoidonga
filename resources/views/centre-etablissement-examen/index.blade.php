@extends('layouts.appespace2')

@section('template_title')
    Centre Etablissement Examens
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            {{-- <span id="card_title">
                                {{ __('Centre Etablissement Examens') }}
                            </span> --}}

                             <div class="float-right">
                                <a href="{{ route('centre-etablissement-examens.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th >{{ __('traduction.centrecompo') }}</th>
                                        <th >{{ __('traduction.etabli') }}</th>
                                        <th >{{ __('traduction.ansclair') }}</th>
                                        <th >{{ __('traduction.exam') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($centreEtablissementExamens as $centreEtablissementExamen)
                                        <tr>

                                            <td>{{ ++$i }}</td>
                                             <td>
                                                <form action="{{ route('centre-etablissement-examens.destroy', $centreEtablissementExamen->public_id) }}" method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('centre-etablissement-examens.show', $centreEtablissementExamen->public_id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}
                                                    <a class="btn btn-sm btn-success" href="{{ route('centre-etablissement-examens.edit', $centreEtablissementExamen->public_id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                            <td >{{ $centreEtablissementExamen->centre->nomar.' '.$centreEtablissementExamen->centre->nomfr }}</td>
                                            <td >{{ $centreEtablissementExamen->etablissement->nomarabe.' '.$centreEtablissementExamen->etablissement->nomfrancais }}</td>
                                            <td >{{ $centreEtablissementExamen->anneescolaire?->anneear }} {{ $centreEtablissementExamen->anneescolaire?->anneefr ?? '' }}</td>
                                            <td >{{ $centreEtablissementExamen->categoriesExamen->libelle}}</td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $centreEtablissementExamens->withQueryString()->links() !!}
            </div>
        </div>
@endsection
