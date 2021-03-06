@extends('layouts.app')
@section('content')
<br>

<div class=" container">
    <h2 class="text-center">Add new Order</h2>
    <form method="post" action="{{route('order.store')}}">
        @csrf
        <label for="date">Date</label>
        <input type="date" id="date" name="date" class=" @error('date') is-invalid @enderror form-control mb-4"
            placeholder="Date">
        @error('date')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="hidden" name="employee_id" value="{{auth()->user()->id}}">
        <label for="payment">Payment type</label>
        <select onchange="viewcustomers()" class="form-control mb-3" name="payment" id="payment">
            <option value="cash">Cash</option>
            <option value="agl">later</option>
        </select>

        <select style="display:none" class="form-control mb-3" name="customer_id" id="customer">
            @foreach ($customers as $customer)
            @if($customer->id !== 1)
            <option selected value="{{$customer->id}}">{{$customer->name}}</option>
            @else
            <option hidden value="{{$customer->id}}">{{$customer->name}}</option>
            @endif
            @endforeach

        </select>
        <div style="text-align: center">
            <input class=" btn btn-primary" value="Go add tickets" type="submit">
        </div>
    </form>

</div>

<script>
    function viewcustomers(){
        if(document.getElementById('payment').value=='agl')
        document.getElementById('customer').style.display="";
        else document.getElementById('customer').style.display="none";
    }
    window.onload = function() {
    let today = new Date().toISOString().slice(0, 10)
        document.getElementById('date').value=today;
};
</script>
@endsection