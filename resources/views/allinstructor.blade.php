@extends('components.dashlayout')

@section('content')
<div class="main-content">

    {{-- Page Header --}}
    <div class="header">
        <div>
            <h1 style="font-size: 28px; color: #1e3c72; margin-bottom: 5px;">Instructors</h1>
            <p style="color: #7f8c8d; margin-top: 5px;">Manage your teaching team</p>
        </div>
        <div class="user-info">
            <div class="avatar">AD</div>
            <span>Admin User</span>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;">
        <div style="background: white; border-radius: 10px; padding: 18px 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.07);">
            <p style="font-size: 12px; color: #7f8c8d; margin: 0 0 4px;">Total instructors</p>
            <p style="font-size: 24px; font-weight: 600; margin: 0; color: #1e3c72;">{{ $instructors->count() }}</p>
        </div>
        <div style="background: white; border-radius: 10px; padding: 18px 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.07);">
            <p style="font-size: 12px; color: #7f8c8d; margin: 0 0 4px;">Active</p>
            <p style="font-size: 24px; font-weight: 600; margin: 0; color: #16a34a;">{{ $instructors->where('status', 1)->count() }}</p>
        </div>
        <div style="background: white; border-radius: 10px; padding: 18px 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.07);">
            <p style="font-size: 12px; color: #7f8c8d; margin: 0 0 4px;">Inactive</p>
            <p style="font-size: 24px; font-weight: 600; margin: 0; color: #dc2626;">{{ $instructors->where('status', 0)->count() }}</p>
        </div>
    </div>

    {{-- Main Card --}}
    <div style="background: white; border-radius: 12px; padding: 28px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

        {{-- Search + Add Button --}}
        <div style="display: flex; gap: 12px; margin-bottom: 20px;">
            <input type="text" id="searchInput" oninput="filterTable()"
                placeholder="Search by name or designation..."
                style="flex: 1; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            <a href="{{ route('add.instructor') }}"
                style="background: #2563eb; color: white; border: none; padding: 10px 20px; border-radius: 6px; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                + Add instructors
            </a>
        </div>

        {{-- Table --}}
        <div style="overflow-x: auto;">
            <table id="instructorsTable" style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <th style="text-align: left; padding: 10px 14px; font-size: 12px; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: 0.04em;">instructors</th>
                        <th style="text-align: left; padding: 10px 14px; font-size: 12px; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: 0.04em;">Designation</th>
                        <th style="text-align: left; padding: 10px 14px; font-size: 12px; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: 0.04em;">Social</th>
                        <th style="text-align: left; padding: 10px 14px; font-size: 12px; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: 0.04em;">Status</th>
                        <th style="text-align: left; padding: 10px 14px; font-size: 12px; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: 0.04em;">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse ($instructors as $instructors)
                    <tr style="border-bottom: 0.5px solid #f3f4f6;">
                        {{-- Avatar + Name --}}
                        <td style="padding: 14px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                @if ($instructors->img && $instructors->img !== 'default.png')
                                    <img src="{{ asset($instructors->img) }}" alt="{{ $instructors->name }}"
                                        style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                @else
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 13px; font-weight: 500;">
                                        {{ mb_substr($instructors->name, 0, 2) }}
                                    </div>
                                @endif
                                <span style="font-weight: 500;">{{ $instructors->name }}</span>
                            </div>
                        </td>

                        {{-- Designation --}}
                        <td style="padding: 14px; color: #6b7280;">{{ $instructors->designation }}</td>

                        {{-- Social Links --}}
                        <td style="padding: 14px;">
                            <div style="display: flex; gap: 8px;">
                                @if ($instructors->facebook_link)
                                    <a href="{{ $instructors->facebook_link }}" target="_blank" rel="noopener noreferrer"
                                        style="width: 28px; height: 28px; border-radius: 6px; border: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: center; color: #374151; text-decoration: none; font-size: 13px;">f</a>
                                @endif
                                @if ($instructors->twitter_link)
                                    <a href="{{ $instructors->twitter_link }}" target="_blank" rel="noopener noreferrer"
                                        style="width: 28px; height: 28px; border-radius: 6px; border: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: center; color: #374151; text-decoration: none; font-size: 13px;">t</a>
                                @endif
                                @if ($instructors->instagram_link)
                                    <a href="{{ $instructors->instagram_link }}" target="_blank" rel="noopener noreferrer"
                                        style="width: 28px; height: 28px; border-radius: 6px; border: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: center; color: #374151; text-decoration: none; font-size: 13px;">ig</a>
                                @endif
                                @if (!$instructors->facebook_link && !$instructors->twitter_link && !$instructors->instagram_link)
                                    <span style="color: #9ca3af; font-size: 12px;">—</span>
                                @endif
                            </div>
                        </td>

                        {{-- Status --}}
                        <td style="padding: 14px;">
                            @if ($instructors->status == 'active')
                                <span style="background: #dcfce7; color: #166534; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 500;">Active</span>
                            @else
                                <span style="background: #fee2e2; color: #991b1b; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 500;">Inactive</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td style="padding: 14px;">
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('instructors.edit', $instructors->id) }}"
                                    style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; padding: 5px 14px; border-radius: 6px; font-size: 12px; font-weight: 500; text-decoration: none;">Edit</a>
                                <form action="{{ route('instructors.delete', $instructors->id) }}" method="POST"
                                    onsubmit="return confirm('Delete {{ $instructors->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; padding: 5px 14px; border-radius: 6px; font-size: 12px; font-weight: 500; cursor: pointer;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 40px; text-align: center; color: #9ca3af; font-size: 14px;">
                            No instructors found. <a href="{{ route('add.instructor') }}" style="color: #2563eb;">Add one now.</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer count --}}
        <div style="margin-top: 16px; padding-top: 14px; border-top: 1px solid #f3f4f6; font-size: 13px; color: #9ca3af;">
            <span id="countLabel">Showing {{ $instructors->count() }} instructors</span>
        </div>
    </div>
</div>

<script>
    function filterTable() {
        const q = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');
        let visible = 0;
        rows.forEach(function(row) {
            const match = row.innerText.toLowerCase().includes(q);
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        document.getElementById('countLabel').textContent = 'Showing ' + visible + ' instructors';
    }
</script>
@endsection