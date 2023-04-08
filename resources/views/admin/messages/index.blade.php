@extends('layouts.admin')
@section('content')
    <div>
        <div class="container">
            <table class="table bg-light-transparent mt-5" style='border-bottom-width:0;'>
                <thead>
                    <tr class='tr_top' style='background-color:black; color: white;'>
                        <th scope="col" class="width-40-table">Mittente</th>
                        <th scope="col">Contenuto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (array_reverse($messages) as $message)
                        <tr class='tr_top'>
                            <td class='mail_color'><strong>Nome:</strong><br> {{ $message->name }} {{ $message->surname }}
                            </td>
                            <td rowspan="2">
                                {{ $message->description }}
                            </td>
                        </tr>
                        <tr class="tr_lato">
                            <td class='mail_color'><strong>Mail:</strong><br> {{ $message->email }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('js/showMessage.js') }}"></script>
@endsection
