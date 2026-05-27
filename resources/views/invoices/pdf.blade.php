<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture {{ $order->invoice->invoice_number }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 14px;
        }
        .header {
            width: 100%;
            margin-bottom: 30px;
        }
        .header td {
            vertical-align: top;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            color: #000;
        }
        .details {
            margin-bottom: 20px;
        }
        .details th {
            text-align: left;
            padding-right: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #f8f8f8;
            font-weight: bold;
        }
        .table .right {
            text-align: right;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <table class="header">
        <tr>
            <td width="50%">
                <div class="title">FACTURE</div>
                <div>N° {{ $order->invoice->invoice_number }}</div>
                <div>Date : {{ $order->invoice->created_at->format('d/m/Y') }}</div>
            </td>
            <td width="50%" align="right">
                <h2>Hanoti</h2>
                <div>La plateforme des Moul Hanout</div>
            </td>
        </tr>
    </table>

    <table class="details">
        <tr>
            <th>Client :</th>
            <td>{{ $order->client->name }}</td>
        </tr>
        <tr>
            <th>Email :</th>
            <td>{{ $order->client->email }}</td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th class="right">Prix Unitaire</th>
                <th class="right">Quantité</th>
                <th class="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product ? $item->product->name : 'Produit inconnu' }}</td>
                <td class="right">{{ number_format($item->price, 2) }} DH</td>
                <td class="right">{{ $item->quantity }}</td>
                <td class="right">{{ number_format($item->price * $item->quantity, 2) }} DH</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="right total">Total de la commande</td>
                <td class="right total">{{ number_format($order->total_price, 2) }} DH</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Merci de votre confiance. Pour toute question, nous contacter via la plateforme Hanoti.
    </div>
</body>
</html>
