@extends('layouts.student')

@section('content')
<div class="student-panel">
    @include('student.head_left', ['info' => $info])
    @include('shared.foot')

    <div class="student-content">
        @include('student.dashboard', ['tests' => $tests, 'scores' => $scores])
        @include('student.chat')
        @include('student.all_chat')
        @include('student.notifications')
        @include('student.exam', ['test' => $test, 'min' => $min, 'sec' => $sec])
        @include('student.result', ['test_code' => $test_code, 'score' => $score, 'result' => $result])
        @include('shared.about')
        @include('shared.profiles', ['profile' => $profile])
        @include('shared.404')
    </div>
</div>
@endsection
