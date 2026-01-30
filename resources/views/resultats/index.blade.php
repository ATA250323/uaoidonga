@extends('layouts.appespace2')

@section('content')
    <div class="pc-container">
        <div class="pc-content">


                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <!-- Filtre année -->
                            <form method="GET" class="mb-3">
                                <select name="annee" class="form-control w-100" onchange="this.form.submit()">
                                    <option value="">Toutes les années</option>
                                    <option value="2023-2024" {{ $annee=='2023-2024'?'selected':'' }}>2023-2024</option>
                                    <option value="2024-2025" {{ $annee=='2024-2025'?'selected':'' }}>2024-2025</option>
                                </select>
                            </form>

                             <div class="float-right">
                                <a href="{{ route('charger') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('traduction.import') }}
                                </a>
                              </div>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    @foreach($colonnes as $col)
                                        <th>{{ ucfirst(str_replace('_',' ',$col)) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resultats as $row)
                                    <tr>
                                        @foreach($colonnes as $col)
                                            <td>{{ $row->$col ?? '-' }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
@endsection
