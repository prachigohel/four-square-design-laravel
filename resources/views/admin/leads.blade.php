@extends('layouts.portal')

@section('title', 'Leads - FourSquareDesign Portal')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <div>
        <h2 style="font-family: var(--font-heading); font-size: 1.6rem; color: #020617; margin: 0;">Leads</h2>
        <p style="color: #64748b; font-size: 0.85rem; margin-top: 0.25rem;">Contact form submissions from the website</p>
    </div>
    <span style="background: #f1f5f9; color: #475569; padding: 0.4rem 1rem; border-radius: 999px; font-size: 0.8rem; font-weight: 700;">{{ $leads->count() }} Results</span>
</div>

{{-- Filter Bar --}}
<form method="GET" action="{{ route('portal.leads') }}">
    <div style="background: #fff; border: 1px solid var(--border-color); border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: flex-end; box-shadow: 0 1px 4px rgba(0,0,0,0.04);">

        {{-- Search --}}
        <div style="display: flex; flex-direction: column; gap: 0.3rem; flex: 1; min-width: 200px;">
            <label style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #64748b;">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or email…"
                style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.85rem; color: #020617; outline: none; background: #f8fafc; width: 100%;">
        </div>

        {{-- Date From --}}
        <div style="display: flex; flex-direction: column; gap: 0.3rem; min-width: 145px;">
            <label style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #64748b;">From</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}"
                style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.85rem; color: #020617; background: #f8fafc; outline: none;">
        </div>

        {{-- Date To --}}
        <div style="display: flex; flex-direction: column; gap: 0.3rem; min-width: 145px;">
            <label style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #64748b;">To</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}"
                style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.85rem; color: #020617; background: #f8fafc; outline: none;">
        </div>

        {{-- Buttons --}}
        <div style="display: flex; gap: 0.5rem; align-items: flex-end;">
            <button type="submit" style="background: var(--primary-color); color: #fff; border: none; border-radius: 8px; padding: 0.52rem 1.1rem; font-size: 0.82rem; font-weight: 700; cursor: pointer; white-space: nowrap;">
                <i class="fas fa-search" style="margin-right: 0.35rem;"></i> Apply
            </button>
            @if(request()->hasAny(['search','date_from','date_to']))
            <a href="{{ route('portal.leads') }}" style="background: #f1f5f9; color: #475569; border-radius: 8px; padding: 0.52rem 1rem; font-size: 0.82rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                <i class="fas fa-times" style="margin-right: 0.3rem;"></i> Clear
            </a>
            @endif
        </div>
    </div>
</form>

@if($leads->isEmpty())
    <div style="text-align: center; padding: 4rem 2rem; background: #fff; border-radius: 12px; border: 1px solid var(--border-color);">
        <i class="fas fa-inbox" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
        <p style="color: #94a3b8; font-size: 1rem;">No leads match your filters.</p>
        @if(request()->hasAny(['search','date_from','date_to']))
            <a href="{{ route('portal.leads') }}" style="color: var(--primary-color); font-size: 0.85rem; font-weight: 600;">Clear filters</a>
        @endif
    </div>
@else
    <div style="background: #fff; border-radius: 12px; border: 1px solid var(--border-color); overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 1rem 1.5rem; text-align: left; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569;">#</th>
                    <th style="padding: 1rem 1.5rem; text-align: left; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569;">Name</th>
                    <th style="padding: 1rem 1.5rem; text-align: left; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569;">Email</th>
                    <th style="padding: 1rem 1.5rem; text-align: left; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569;">Message</th>
                    <th style="padding: 1rem 1.5rem; text-align: left; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569;">Received</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $index => $lead)
                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background='#fff'">
                    <td style="padding: 1rem 1.5rem; font-size: 0.8rem; color: #94a3b8; font-weight: 700;">{{ $index + 1 }}</td>
                    <td style="padding: 1rem 1.5rem;">
                        <div style="font-weight: 700; font-size: 0.9rem; color: #020617;">{{ $lead->name }}</div>
                    </td>
                    <td style="padding: 1rem 1.5rem;">
                        <a href="mailto:{{ $lead->email }}" style="color: var(--primary-color); font-size: 0.875rem; text-decoration: none; font-weight: 500;">{{ $lead->email }}</a>
                    </td>
                    <td style="padding: 1rem 1.5rem; max-width: 400px;">
                        <p style="color: #475569; font-size: 0.85rem; margin: 0; line-height: 1.5; white-space: pre-wrap;">{{ Str::limit($lead->message, 120) }}</p>
                        @if(strlen($lead->message) > 120)
                            <button onclick="toggleMessage(this)" data-full="{{ e($lead->message) }}" data-short="{{ e(Str::limit($lead->message, 120)) }}" style="background: none; border: none; color: var(--primary-color); font-size: 0.75rem; cursor: pointer; padding: 0.25rem 0; font-weight: 600;">Read more</button>
                        @endif
                    </td>
                    <td style="padding: 1rem 1.5rem; white-space: nowrap;">
                        <div style="font-size: 0.8rem; color: #475569;">{{ $lead->created_at->format('d M, Y') }}</div>
                        <div style="font-size: 0.72rem; color: #94a3b8;">{{ $lead->created_at->format('h:i A') }}</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection

@section('scripts')
<script>
    function toggleMessage(btn) {
        const td = btn.previousElementSibling;
        if (btn.textContent === 'Read more') {
            td.textContent = btn.dataset.full;
            btn.textContent = 'Show less';
        } else {
            td.textContent = btn.dataset.short;
            btn.textContent = 'Read more';
        }
    }
</script>
@endsection
