@extends('layouts.app') 
@section('content')
    <h1>{{ __('Exam Create') }}</h1>
        
    @can('建立測驗')

        {{ bs()->openForm('post', '/exam') }} 
        {{ bs()->formGroup()
            ->label('測驗標題')
            ->control(bs()->text('title')->placeholder('請在此填入測驗標題'))
            }}
        
        {{ bs()->formGroup()
            ->label('測驗是否開啟?')
            ->control(bs()->radioGroup('enable', [1 => '啟用', 0 => '關閉']) 
            ->selectedOption(1) 
            ->inline())
            }}
        
        {{ bs()->formGroup()
            ->label('檔案上傳')
            ->control(bs()->file('avatar2', '選擇一個檔案'))
            }}
        {{ bs()->hidden('user_id', Auth::id()) }}  
        {{ bs()->submit('儲存') }}


        {{ bs()->closeForm() }}
    @else
        @component('bs::alert', ['type' => 'info', 'animated' => true, 'dismissible' => true, 'data' => ['alert-id' => 40, 'context' => 'sample-code']])
        @slot('heading')
            您沒有建立測驗的權限
        @endslot

            <p>請先登入或確定身分</p>
        @endcomponent
        @endcan
@endsection
