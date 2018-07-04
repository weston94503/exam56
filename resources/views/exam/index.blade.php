@extends('layouts.app') 
@section('content')
    <h1>{{ __('隨機題庫系統') }}</h1>
    <h1>測驗一覽</h1>
    <ul class="list-group">
        @forelse($exams as $exam)
            <li class="list-group-item">
                {{ $exam->created_at->format("Y年m月d日") }} -
                <a href="exam/{{ $exam->id }}">
                    {{ $exam->title }}
                </a>
            </li>
        @empty
        <li class="list-group-item">尚無任何測驗</l
        @endforelse

        <div class="my-3">
            {{ $exams->links() }}
        </div>
    </ul>

@endsection

