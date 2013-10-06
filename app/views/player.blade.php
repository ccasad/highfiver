<?php

@extends('layouts.master');

@section('title')
@parent
:: {{ $player->name }}
@stop

@section('content')
    <div class="container">
        {{ $player->name }}
    </div>
@stop
