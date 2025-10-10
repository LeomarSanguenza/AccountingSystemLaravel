@extends('layout')

@section('title', 'Bottle Collector')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">🧴 Bottle Collector Earnings Calculator</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('bottlecollector.calculate') }}">
                @csrf

                <div class="mb-3">
                    <label for="daily_expenses" class="form-label fw-semibold">Daily Expenses (₱)</label>
                    <input type="number" 
                           step="0.01"
                           name="daily_expenses"
                           id="daily_expenses"
                           value="{{ old('daily_expenses', $daily_expenses ?? '') }}"
                           class="form-control @error('daily_expenses') is-invalid @enderror"
                           placeholder="Enter daily expenses">
                    @error('daily_expenses')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="expeditions" class="form-label fw-semibold">Expedition Logs</label>
                    <textarea name="expeditions"
                              id="expeditions"
                              rows="6"
                              class="form-control @error('expeditions') is-invalid @enderror"
                              placeholder="Example:&#10;6 BBBB 2.5&#10;4 BxBx 3.0&#10;8 BxBB 2.0">{{ old('expeditions', isset($expedition_lines) ? implode("\n", $expedition_lines) : '') }}</textarea>
                    @error('expeditions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: <code>[hours] [path] [price]</code> — e.g., <code>6 BBBxB 2.5</code></small>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-calculator"></i> Calculate
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if(isset($message))
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">💰 Results</h5>
            </div>
            <div class="card-body">
                <p><strong>Total Earnings:</strong> ₱{{ number_format($total_earnings, 2) }}</p>
                <p><strong>Average Earnings per Day:</strong> ₱{{ number_format($average_earnings, 2) }}</p>
                <p><strong>Daily Expenses:</strong> ₱{{ number_format($daily_expenses, 2) }}</p>
                <hr>
                <h5 class="text-center fw-bold {{ str_contains($message, 'Good') ? 'text-success' : 'text-danger' }}">
                    {{ $message }}
                </h5>
            </div>
        </div>
    @endif
</div>
@endsection
