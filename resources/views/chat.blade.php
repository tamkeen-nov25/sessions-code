@extends('layouts.app')
@section('content')
    @vite(['resources/js/chat.js'])
    <h1>دردشة فورية (Real-time) مع Laravel Echo و Pusher 🚀</h1>

    <form id="form">
        <input type="text" id="message" placeholder="اكتب رسالة..." required>
        <button type="submit">إرسال</button>
    </form>

    <h2>الرسائل:</h2>
    <ul id="messages"></ul>


@endsection
