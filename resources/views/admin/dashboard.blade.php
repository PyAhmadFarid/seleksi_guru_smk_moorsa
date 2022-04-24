@extends('template.admin')

@section('content')
    <div class="flex justify-between">
        <div class=" font-bold text-2xl py-5">Dashboard</div>
        {{-- <button class="">Add jobs</button> --}}

    </div>


    <div class=" bg-white border rounded-lg p-5">
        {{-- <div class="p-5 font-semibold border-b">Data Pegawai :</div> --}}

        <table class="w-full">
            <thead>
                <tr>
                    <th class=" text-left p-3">Nama</th>
                    <th class=" text-left p-3">Simbol</th>
                    <th class=" text-left p-3">Skor</th>
                    <th class=" text-left p-3">Peringkat</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count=0;
                @endphp
                @foreach ($ymaxmin as $i=>$ymax)
                    @php
                    $count+=1;
                        $gr = $guru->find($i);
                    @endphp
                    <tr>
                        <td class="p-3 font-semibold">{{$gr->name}}</td>
                        <td class="p-3">{{$gr->simbol}}</td>
                        <td class="p-3">{{$ymax}}</td>
                        <td class="p-3">{{$count}}</td>
                    </tr>
                @endforeach



            </tbody>
        </table>

    </div>
@endsection
