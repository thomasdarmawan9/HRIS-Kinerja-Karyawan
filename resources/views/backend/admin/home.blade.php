@extends('backend.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="app-page-title" style="height:100%">
        <div class="page-title-wrapper" style="height:100%;position:relative;">
            <div class="page-title-heading text-center" style="margin:0px;position:absolute;top:50%;left:25%">
                <div class="page-title-icon">
                    <i class="pe-7s-home icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>WELCOME IN HUMAN RESOURCE ALAMANDA APPS
                    <div class="page-title-subheading">
                        This is your home page welcome  {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
  @endsection
