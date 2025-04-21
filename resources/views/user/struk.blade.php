<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Struk Belanja</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --navy: #001f3f;
      --navy-hover: #003366;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: #f5f7fa;
      margin: 30px;
      color: #333;
      font-size: 14px;
    }

    .btn-primary {
      background-color: var(--navy);
      border-color: var(--navy);
    }

    .btn-primary:hover {
      background-color: var(--navy-hover);
      border-color: var(--navy-hover);
    }

    .container {
      background-color: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
      max-width: 800px;
      margin: auto;
    }

    .header {
      text-align: center;
      font-weight: 600;
      color: #001f3f;
      font-size: 22px;
      border-bottom: 2px solid #001f3f;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .header span {
      font-size: 16px;
      color: #555;
      display: block;
      margin-top: 4px;
    }

    .info table {
      width: 100%;
      margin-bottom: 20px;
    }

    .info td {
      padding: 6px;
      vertical-align: top;
    }

    .tabel-produk table {
      width: 100%;
      border-collapse: collapse;
    }

    .tabel-produk th,
    .tabel-produk td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }

    .tabel-produk th {
      background-color: #001f3f;
      color: white;
    }

    .tabel-produk tr:nth-child(even) {
      background-color: #f2f6fc;
    }

    .right {
      text-align: right;
    }

    .total {
      font-weight: 600;
      color: #001f3f;
      background-color: #e6ecf7;
      padding: 10px;
      margin-top: 15px;
      border-radius: 6px;
    }

    .footer {
      text-align: center;
      font-weight: 600;
      color: #001f3f;
      margin-top: 40px;
    }
  </style>
</head>

<body>
  <a class="btn btn-primary absolute" href="{{ route('orders.index') }}" role="button">Kembali</a>

  <div class="container">
    <div class="header">
      TOKO ALAT KESEHATAN
      <span>Laporan Belanja Anda</span>
    </div>

    <div class="info">
      <table>
        <tr>
          <td><strong>User ID:</strong></td>
          <td>{{ $order->user->id }}</td>
          <td><strong>Tanggal:</strong></td>
          <td>{{ $order->created_at->format('d-m-Y') }}</td>
        </tr>
        <tr>
          <td><strong>Nama:</strong></td>
          <td>{{ $order->user->username }}</td>
          <td><strong>ID Paypal:</strong></td>
          <td>{{ $order->user->paypalId }}</td>
        </tr>
        <tr>
          <td><strong>Alamat:</strong></td>
          <td>{{ $order->user->address }}</td>
          <td><strong>Nama Bank:</strong></td>
          <td>{{ strtoupper($order->bank_name) ?? '-' }}</td>
        </tr>
        <tr>
          <td><strong>No HP:</strong></td>
          <td>{{ $order->user->number }}</td>
          <td><strong>Metode Pembayaran:</strong></td>
          <td>{{ ucfirst($order->payment_method) }} - {{ ucfirst($order->payment_type) }}</td>
        </tr>
      </table>
    </div>

    <div class="tabel-produk">
      <table>
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Produk (ID)</th>
            <th>Jumlah</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
          @php $total = 0; @endphp
          @foreach ($order->items as $index => $item)
          <tr>
            <td>{{ $index + 1 }}.</td>
            <td>{{ $item->product->name ?? 'Produk Tidak Ditemukan' }} (ID: {{ $item->product->id ?? '-' }})</td>
            <td>{{ $item->quantity }}</td>
            <td>Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
          </tr>
          @php $total += $item->price * $item->quantity; @endphp
          @endforeach
        </tbody>
      </table>

      <p class="right total">
        Total belanja (termasuk pajak): Rp. {{ number_format($total, 0, ',', '.') }}
      </p>
    </div>

    <div class="footer">
      TANDATANGAN TOKO
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>


</html>