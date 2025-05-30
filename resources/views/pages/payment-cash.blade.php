<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details (Cash)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        amber: {
                            50: '#fdf8f2',
                            100: '#faebd7',
                            200: '#f5deb3',
                        },
                        golden: {
                            DEFAULT: '#A66E38',
                            dark: '#8B5A2B',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-[#fdf8f2]">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-3xl font-bold mb-6 text-[#A66E38]">Detail Pembayaran</h1>
            <div class="bg-gradient-to-br from-amber-50 via-amber-100/30 to-[#fdf5e9] rounded-lg shadow-lg overflow-hidden mb-6">
                <div class="bg-[#A66E38] text-white px-6 py-4">
                    <h2 class="text-xl font-semibold">Ringkasan Pemesanan</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between border-b border-amber-100 pb-3">
                        <span class="font-medium">Nama Pemesan:</span>
                        <span>{{ $customer_name }}</span>
                    </div>
                    <div class="flex justify-between border-b border-amber-100 pb-3">
                        <span class="font-medium">Email:</span>
                        <span>{{ $customer_email }}</span>
                    </div>
                    <div class="flex justify-between border-b border-amber-100 pb-3">
                        <span class="font-medium">Nomor Handphone:</span>
                        <span>{{ $customer_phone }}</span>
                    </div>
                    <div class="flex justify-between border-b border-amber-100 pb-3">
                        <span class="font-medium">Waktu:</span>
                        <span>{{ \Carbon\Carbon::parse($booking_date)->format('d M Y') }}</span>
                    </div>
                    <div class="border-t border-amber-100 pt-4 mb-2">
                        <h3 class="font-semibold mb-2 text-[#8B5A2B]">Lapangan yang Dipesan:</h3>
                        <div class="space-y-1">
                            @php $total = 0; @endphp
                            @foreach($selected_fields as $fieldId)
                            @php
                            $field = \App\Models\Field::find($fieldId);
                            $slots = $selected_slots[$fieldId] ?? [];
                            $start = $slots ? \Carbon\Carbon::parse($slots[0])->format('H:i') : '-';
                            $end = $slots ? \Carbon\Carbon::parse(end($slots))->addHour()->format('H:i') : '-';
                            $subtotal = ($field ? $field->price_per_hour : 0) * count($slots);
                            $total += $subtotal;
                            @endphp
                            <div>
                                <span class="font-bold text-[#A66E38]">{{ $field ? $field->name : 'Lapangan' }}</span>:
                                {{ $start }}-{{ $end }}
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex justify-between text-lg font-bold mt-4">
                        <span>Total Biaya:</span>
                        <span id="total-amount" class="text-[#A66E38]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-center mt-6">
                        <a href="{{ $waUrl }}" target="_blank"
                            class="inline-flex items-center px-6 py-3 bg-[#A66E38] hover:bg-[#8B5A2B] text-white font-semibold rounded-lg shadow transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.52 3.48A12.07 12.07 0 0012 0C5.37 0 0 5.37 0 12c0 2.12.55 4.22 1.6 6.08L0 24l6.16-1.6A12.07 12.07 0 0012 24c6.63 0 12-5.37 12-12 0-3.22-1.25-6.25-3.48-8.52zM12 22c-1.85 0-3.67-.49-5.24-1.42l-.37-.22-3.67.95.98-3.58-.24-.37A10.06 10.06 0 012 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.07-7.75c-.28-.14-1.64-.81-1.89-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.17-.43-2.23-1.38-.82-.73-1.37-1.62-1.53-1.9-.16-.28-.02-.43.12-.57.12-.12.28-.32.41-.48.14-.16.18-.28.28-.46.09-.18.05-.34-.02-.48-.07-.14-.61-1.47-.83-2.02-.22-.53-.44-.45-.61-.46-.16-.01-.34-.01-.52-.01-.18 0-.48.07-.73.34-.25.28-.97.94-.97 2.3 0 1.36.99 2.67 1.13 2.85.14.18 1.95 2.98 4.74 4.06.66.28 1.17.45 1.57.57.66.21 1.26.18 1.73.11.53-.08 1.64-.67 1.87-1.31.23-.63.23-1.18.16-1.31-.07-.13-.25-.2-.53-.34z" />
                            </svg>
                            Konfirmasi ke Admin via WhatsApp
                        </a>
                    </div>
                    <div class="mt-4 p-3 bg-amber-100 border-l-4 border-[#A66E38] text-[#8B5A2B] rounded">
                        <b>Booking Anda akan diproses setelah admin mengkonfirmasi pesanan ini.</b><br>
                        Silakan klik tombol <b>Konfirmasi ke Admin via WhatsApp</b> di atas.<br>
                        Setelah admin mengkonfirmasi, Anda akan menerima notifikasi dan booking akan masuk sistem.
                    </div>
                </div>
            </div>
            <div class="text-center mt-6">
    <a href="/" class="inline-flex items-center px-5 py-3 bg-[#A66E38] hover:bg-[#8B5A2B] text-white font-medium rounded-lg shadow transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke halaman utama
    </a>
</div>

        </div>
    </div>
</body>

</html>
