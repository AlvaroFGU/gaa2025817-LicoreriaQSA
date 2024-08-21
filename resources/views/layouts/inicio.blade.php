@extends('layouts.master')
@section('content')
  

@endsection

<style>
    .iframe-container {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%; /* Aspect ratio 16:9 */
        height: 0;
        overflow: hidden;
        max-width: 100%;
        background: #000;
    }

    .iframe-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 95%;
        border: 0;
    }
</style>
