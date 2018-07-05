@extends('layouts.app') 
@section('content')
    <h1>{{ __('Exam Create') }}</h1>
    

    @can('建立測驗')
    @if(isset($exam))
        {{ bs()->openForm('patch', "/exam/{$exam->id}" , [ 'model' => $exam]) }}
    @else
        {{ bs()->openForm('post', '/exam') }}
    @endif

        {{ bs()->formGroup()
            ->label('測驗標題')
            ->control(bs()->text('title')->placeholder('請在此填入測驗標題'))
            }}
        
        {{ bs()->formGroup()
            ->label('測驗是否開啟?')
            ->control(bs()->radioGroup('enable', [1 => '啟用', 0 => '關閉'])
            ->selectedOption(isset($exam)?$exam->enable:1)
            ->inline())
            ->showAsRow()
            }}
        
        {{ bs()->formGroup()
            ->label('檔案上傳')
            ->control(bs()->file('avatar2', '選擇一個檔案'))
            }}
        {{ bs()->hidden('user_id', Auth::id()) }}  
        {{ bs()->submit('儲存') }}


        {{ bs()->closeForm() }}

        @if (count($errors) > 0)
            @component('bs::alert', ['type' => 'danger'])
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endcomponent
        @endif

    @else
        @component('bs::alert', ['type' => 'info', 'animated' => true, 'dismissible' => true, 'data' => ['alert-id' => 40, 'context' => 'sample-code']])
        @slot('heading')
            您沒有建立測驗的權限
        @endslot

            <p>請先登入或確定身分</p>
        @endcomponent
        @endcan
@endsection
