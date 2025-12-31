@extends('admin.layouts.app')

@section('title', 'Riwayat Topup User')

@section('content')
<div class="container mx-auto p-6">

    <h1 class="text-3xl font-bold text-white mb-6">Riwayat Topup User</h1>

    <div class="bg-[#0b1220] p-6 rounded-lg shadow border border-gray-700">

        <table class="w-full text-left text-gray-300">
            <thead>
                <tr class="border-b border-gray-700">
                    <th class="py-3">User</th>
                    <th class="py-3">Nominal</th>
                    <th class="py-3">Tanggal</th>
                    <th class="py-3">Status</th>
                    <th class="py-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($topups as $topup)
                <tr class="border-b border-gray-700">
                    <td class="py-2">{{ $topup->user->name }}</td>
                    <td class="py-2">Rp {{ number_format($topup->amount, 0, ',', '.') }}</td>
                    <td class="py-2">{{ $topup->created_at->format('d M Y H:i') }}</td>
                    <td class="py-2">
                        @if($topup->status == 'pending')
                            <span class="text-yellow-400">Pending</span>
                        @elseif($topup->status == 'approved')
                            <span class="text-green-400">Approved</span>
                        @else
                            <span class="text-red-400">Rejected</span>
                        @endif
                    </td>
                    <td class="py-2 flex gap-2">

                        @if($topup->status == 'pending')
                        <form action="{{ route('admin.topups.approve', $topup->id) }}" method="POST">
                            @csrf
                            <button class="bg-green-500 px-3 py-1 rounded text-black font-semibold">Approve</button>
                        </form>

                        <form action="{{ route('admin.topups.reject', $topup->id) }}" method="POST">
                            @csrf
                            <button class="bg-red-500 px-3 py-1 rounded text-black font-semibold">Reject</button>
                        </form>
                        @else
                            <span class="text-gray-400 italic">No Action</span>
                        @endif

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $topups->links() }}
        </div>

    </div>
</div>
@endsection
