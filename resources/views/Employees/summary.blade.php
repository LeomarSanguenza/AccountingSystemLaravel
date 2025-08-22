@extends('layout')

@section('content')
<div class="container mt-5">
    <h2>Employee Summary</h2>
    <ul class="list-group">
        <li class="list-group-item"><strong>Male Employees:</strong> {{ $maleCount }}</li>
        <li class="list-group-item"><strong>Female Employees:</strong> {{ $femaleCount }}</li>
        <li class="list-group-item"><strong>Average Age:</strong> {{ round($averageAge, 2) }} years</li>
        <li class="list-group-item"><strong>Total Monthly Salary:</strong> ${{ number_format($totalSalary, 2) }}</li>
    </ul>
</div>
@endsection