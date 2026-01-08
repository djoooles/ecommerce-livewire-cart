<!DOCTYPE html>
<html>
<head>
    <title>Low Stock Alert</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; }
        .content { background-color: #f9f9f9; padding: 20px; border-radius: 5px; margin-top: 20px; }
        .product { border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 5px; }
        .warning { color: #856404; background-color: #fff3cd; border-color: #ffeaa7; padding: 10px; border-radius: 4px; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>⚠️ Low Stock Alert</h2>
            <p>Product is running low on stock!</p>
        </div>
        
        <div class="content">
            <p>Hello Admin,</p>
            
            <div class="warning">
                <strong>Attention:</strong> The following product is running low on stock and needs to be restocked soon.
            </div>
            
            <div class="product">
                <h3>{{ $product->name }}</h3>
                <p><strong>Current Stock:</strong> {{ $product->stock_quantity }} units</p>
                <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Product ID:</strong> {{ $product->id }}</p>
            </div>
            
            <p>Please consider restocking this product to avoid running out of stock.</p>
            
            <p>
                <a href="{{ url('/products/' . $product->id) }}" style="background-color: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">
                    View Product Details
                </a>
            </p>
        </div>
        
        <div class="footer">
            <p>This is an automated message from {{ config('app.name') }}.</p>
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>