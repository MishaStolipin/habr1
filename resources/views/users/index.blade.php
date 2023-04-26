@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-auto">
                    <a href="{{ route('blog.admin.categories.create') }}" class="btn btn-success">
                        Создать
                    </a>
                </div>
            </div>

            @forelse($users as $user)
                <div class="row pb-2">
                    <div class="col-1">
                        {{$user->getKey()}}
                    </div>
                    <div class="col-6">
                        {{$user->getName()}}
                    </div>
                    <div class="col-5">
                        <a href="{{route('users.edit','$user')}}" class="btn btn-success">
                            Редактировать
                        </a>
{{--                        {{Form::open(['method'=>'DELETE','route'=>route('users.destroy', $user)])}}--}}
                        <button class="btn btn-danger">
                            удалить
                        </button>
{{--                        {{Form::close()}}--}}
                    </div>
                </div>
                @empty
                @endforelse
        </div>
    </div>
@endsection

