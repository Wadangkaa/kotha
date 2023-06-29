
@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/mypost.css') }}">
    <style>
        img {
            object-fit: cover;
        }
    </style>
@endsection


@section('content')
<x-alert/>
    <table class="table table-striped table-inverse ">
        <tbody>

            @forelse ($kothas as $kotha)
                <tr>
                    <td class="col-2">
                        <img class="w-100 h-100" src="{{ asset('storage/uploads/' . $kotha->images->first()->image_url) }}"
                            alt="Image">
                    </td>
                    <td class="col-9">
                        <div class="flex-column justify-content-between">
                            <div class="row d-flex flex-column">
                                <div>
                                    <h3 class="font-weight-semi-bold">Description</h3>
                                </div>
                                <div>
                                    <p class="mb-4">
                                        {{ $kotha->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="col">

                        <div id='buttons' class="row justify-content-between">
                            <a href="{{ route('admin.kotha.preview', $kotha) }}">
                                <div class="icon">
                                    <button type="button" class="btn btn-primary">View</button>
                                </div>
                            </a>
                        </div>

                    </td>
                </tr>
                @empty
                <tr>
                    <td>No Kotha pending</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
