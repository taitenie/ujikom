<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Struk Belanja</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f5f7fa;
      margin: 30px;
      color: #333;
      font-size: 14px;
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

    .tabel-produk th, .tabel-produk td {
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
  <div class="container">
    <div class="header">
      TOKO ALAT KESEHATAN
      <span>Laporan Belanja Anda</span>
    </div>

    <div class="info">
      <table>
        <tr>
          <td><strong>User ID:</strong></td><td>{{ auth()->user()->id }}</td>
          <td><strong>Tanggal:</strong></td><td>{{ date('d-m-Y') }}</td>
        </tr>
        <tr>
          <td><strong>Nama:</strong></td><td>{{ auth()->user()->username }}</td>
          <td><strong>ID Paypal:</strong></td><td>__________________</td>
        </tr>
        <tr>
          <td><strong>Alamat:</strong></td><td>__________________</td>
          <td><strong>Nama Bank:</strong></td><td>__________________</td>
        </tr>
        <tr>
          <td><strong>No HP:</strong></td><td>__________________</td>
          <td><strong>Metode Pembayaran:</strong></td><td>(Prepaid/Postpaid)</td>
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
          @php
            $total = 0;
            $no = 1;
          @endphp
          @foreach (session('cart', []) as $item)
          <tr>
            <td>{{ $no++ }}.</td>
            <td>{{ $item['name'] }} (ID: {{ $item['id'] }})</td>
            <td>{{ $item['quantity'] }}</td>
            <td>Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
          </tr>
          @php $total += $item['price'] * $item['quantity']; @endphp
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
</body>
</html>