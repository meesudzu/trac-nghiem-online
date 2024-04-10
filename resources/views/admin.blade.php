@extends('layouts.admin')

@section('content')
<div class="admin-panel">
    @include('admin.head_left', ['info' => $info])
    @include('shared.foot')

    <div class="admin-content">
        @include('admin.admins_panel')
        @include('admin.dashboard', ['dashboard' => $dashboard])
        @include('admin.teachers_panel')
        @include('admin.classes_panel')
        @include('admin.students_panel')
        @include('admin.questions_panel')
        @include('admin.add_question')
        @include('admin.edit_question', ['question' => $question, 'grades' => $grades, 'subjects' => $subjects])
        @include('admin.subjects_panel')
        @include('admin.tests_panel')
        @include('admin.tests_detail', ['questions' => $questions])
        @include('admin.test_score', ['test_code' => $test_code, 'scores' => $scores])
        @include('admin.notifications_panel')
        @include('shared.about')
        @include('shared.profiles', ['profile' => $profile])
        @include('shared.404')
    </div>
</div>
@endsection
