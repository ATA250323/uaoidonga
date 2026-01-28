@extends('layouts.appespace2')

@section('template_title')
    Categories Examens
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            {{-- <span id="card_title">
                                {{ __('Categories Examens') }}
                            </span> --}}

                             <div class="float-right">
                                <a href="{{ route('categories-examens.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>{{ __('traduction.action') }}</th>
                                        {{-- <th>{{ __('traduction.num') }}</th> --}}
                                        <th >{{ __('traduction.prefixeet') }}</th>
                                        <th >{{ __('traduction.exam') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categoriesExamens as $categoriesExamen)
                                        <tr>
                                            <td>
                                                <form action="{{ route('categories-examens.destroy', $categoriesExamen->public_id) }}" method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('categories-examens.show', $categoriesExamen->public_id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}
                                                    <a class="btn btn-sm btn-success" href="{{ route('categories-examens.edit', $categoriesExamen->public_id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                            {{-- <td>{{ ++$i }}</td> --}}

                                            <td >{{ $categoriesExamen->code }}</td>
                                            <td >{{ $categoriesExamen->libelle }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $categoriesExamens->withQueryString()->links() !!}
            </div>
        </div>
@endsection
