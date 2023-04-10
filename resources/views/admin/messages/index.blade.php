@extends('layouts.admin')
@section('content')
    <div>
        <div class="container">
            <table class="table bg-light-transparent mt-5">
                <thead>
                    <tr style='background-color:black; color: white;'>
                        <th scope="col" class="width-40-table">Mittente</th>
                        <th scope="col">Contenuto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (array_reverse($messages) as $message)
                        <tr>
                            <td class="d-flex flex-column">
                                <div>
                                    <strong>Nome e cognome:</strong><br> {{ $message->name }} {{ $message->surname }}
                                </div>
                                <div>
                                    <strong>Mail:</strong><br> {{ $message->email }}
                                </div>
                            </td>
                            <td>
                                {{ $message->description }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('js/showMessage.js') }}"></script>
@endsection
