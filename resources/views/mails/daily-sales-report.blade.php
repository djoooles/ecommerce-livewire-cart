<!DOCTYPE html>
<html>
<head>
    <title>Daily Sales Report - {{ date('Y-m-d') }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; }
        .header { background-color: #007bff; color: white; padding: 20px; border-radius: 5px; text-align: center; }
        .content { background-color: #f9f9f9; padding: 20px; border-radius: 5px; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; font-weight: bold; }
        tr:hover { background-color: #f5f5f5; }
        .summary { background-color: #e7f3ff; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; font-size: 12px; color: #666; }
        .no-data { text-align: center; padding: 40px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>📊 Daily Sales Report</h2>
            <p>{{ date('F j, Y') }}</p>
        </div>
        
        <div class="content">
            <p>Hello Admin,</p>
            <p>Here is your daily sales report for <strong>{{ date('F j, Y') }}</strong>:</p>
            
            @if($sales && $sales->count() > 0)
                <div class="summary">
                    <h3>📈 Sales Summary</h3>
                    <p><strong>Total Sales Today:</strong> ${{ number_format($totalSales, 2) }}</p>
                    <p><strong>Number of Items Sold:</strong> {{ $sales->sum('quantity') }}</p>
                    <p><strong>Number of Transactions:</strong> {{ $sales->groupBy('cart_id')->count() }}</p>
                </div>
                
                <h3>🛒 Detailed Sales</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->product->price ?? 0, 2) }}</td>
                            <td>${{ number_format($item->quantity * ($item->product->price ?? 0), 2) }}</td>
                            <td>{{ $item->created_at->format('H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="font-weight: bold;">
                            <td colspan="3" style="text-align: right;">Total:</td>
                            <td>${{ number_format($totalSales, 2) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            @else
                <div class="no-data">
                    <h3>📭 No Sales Today</h3>
                    <p>There were no sales recorded for today.</p>
                </div>
            @endif
            
            <p style="margin-top: 30px;">
                <a href="{{ url('/admin/dashboard') }}" style="background-color: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">
                    View Dashboard
                </a>
            </p>
        </div>
        
        <div class="footer">
            <p>This is an automated daily report from {{ config('app.name') }}.</p>
            <p>Report generated at: {{ now()->format('H:i:s') }}</p>
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>