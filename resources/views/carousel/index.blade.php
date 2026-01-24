@extends('layouts.appespace2')

@section('template_title')
    Carousels
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
            {{-- <h2> {{ __('traduction.accblog') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</h2> --}}
                        <div class="card card-default">
                            <div class="card-header">
                                <h4>{{ __('traduction.photo_bienvenu') }}</h4>
                            </div>
                            <div class="card-body bg-white">
                                <div x-data="{ open: false }" class="mt-3">
                                    <button @click="open = !open" class="btn btn-sm btn-success"><i class="fa fa-fw fa-eye"></i> <span x-text="open ? '−' : '+'" style="color:rgb(246, 242, 242);"></span>
                                    </button>
                                    <div x-show="open" class="mt-2" x-transition>
                                        <div class="row">
                                            @if ($carouselCount > 1)
                                                <p style="color: red" class="alert alert-info">{{ $carouselCount - 3 }} {{ __('traduction.enregistrement') }} </p>
                                            @else
                                            @endif
                                            <div class="row">
                                                <div class="grid grid-cols-12 gap-3 mb-3">
                                                    @foreach ($carousels as $carousel)
                                                        <div class="col-span-12 xl:col-span-4 md:col-span-4">
                                                            <div class="card border-0 shadow-sm rounded-4 p-3 hover-card" style="transition: transform 0.3s;">
                                                                <div class="card-body ">
                                                                    <img class="img-fluid w-100" src="{{ asset('storage/' . $carousel->image) }}" class="rounded-full" width="150" height="150">
                                                                    <div class="d-flex">
                                                                        {{-- <h4 class="">Kitchen</h4>
                                                                        <small class="">72 Projects</small> --}}
                                                                     <br>
                                                                           <form action="{{ route('carousels.destroy', $carousel->public_id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
                                                                        </form>
                                                                        <br>
                                                                        <div x-data="{ open: false }" >
                                                                                <button @click="open = !open" class="btn btn-sm btn-success">
                                                                                    <i class="fa fa-fw fa-edit"></i> <span x-text="open ? '−' : '+'" style="color:rgb(246, 242, 242);"></span>
                                                                                </button>
                                                                            <div x-show="open" class="mt-2" x-transition>
                                                                                <form method="POST" action="{{ route('carousels.update',  $carousel->public_id) }}"  role="form" enctype="multipart/form-data">
                                                                                    {{ method_field('PATCH') }}
                                                                                    @csrf

                                                                                    @include('carousel.edit')

                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- <div class="grid grid-cols-12 gap-x-6">
                                                                <span class="icon-bg"><img src="{{ asset('storage/' . $carousel->image) }}" class="rounded-full" width="250" height="250"></span>

                                                            <div  class="mt-3">
                                                                <br><br>
                                                                    <form action="{{ route('carousels.destroy', $carousel->public_id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
                                                                    </form>


                                                                <div x-data="{ open: false }" >
                                                                        <button @click="open = !open" class="btn btn-sm btn-success">
                                                                            <i class="fa fa-fw fa-edit"></i> <span x-text="open ? '−' : '+'" style="color:rgb(246, 242, 242);"></span>
                                                                        </button>
                                                                    <div x-show="open" class="mt-2" x-transition>
                                                                        <form method="POST" action="{{ route('carousels.update',$carousel->public_id) }}"  role="form" enctype="multipart/form-data">
                                                                            {{ method_field('PATCH') }}
                                                                            @csrf

                                                                            @include('carousel.edit')

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @if ($carouselCount < 3)
                                        <div x-data="{ open: false }" class="mt-3">
                                            <button @click="open = !open" class="btn btn-sm btn-success"><i class="fa fa-fw fa-plus"></i> <span x-text="open ? '−' : '+'" style="color:rgb(246, 242, 242);"></span>
                                            </button>
                                                <div x-show="open" class="mt-2" x-transition>
                                                    <form method="POST" action="{{ route('carousels.store') }}"  role="form" enctype="multipart/form-data">
                                                        @csrf
                                                        @include('carousel.create')
                                                    </form>
                                                </div>
                                        </div>
                                @endif
                            </div>
                        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
