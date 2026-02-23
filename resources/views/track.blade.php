@extends('layouts.app')

@section('title', 'Track Inventory')

@section('content')
    <h1>Track Inventory</h1>
    <p>Use the form below to track your inventory.</p>

    <form>
        <div class="mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="productName" placeholder="Enter product name">
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" placeholder="Enter quantity">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" placeholder="Enter price">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
