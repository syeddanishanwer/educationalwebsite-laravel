@extends('components.dashlayout')


@section('content')

<div class="main-content">

    {{-- Header --}}
    <div class="header">
        <div>
            <h1 style="font-size: 28px; color: #1e3c72; margin-bottom: 5px;">All Instructors</h1>
            <p style="color: #7f8c8d; margin-top: 5px;">Manage your team of instructors</p>
        </div>
        <div class="user-info">
            <div class="avatar">AD</div>
            <span>Admin User</span>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-title">Total Instructors</div>
            <div class="stat-number">12</div>
            <div class="stat-change">↑ 2 new this month</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Active</div>
            <div class="stat-number">10</div>
            <div class="stat-change">83% active rate</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Social Connected</div>
            <div class="stat-number">8</div>
            <div class="stat-change">Linked social profiles</div>
        </div>
    </div>

    {{-- Instructors Table --}}
    <div class="recent-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div class="section-title">Instructors List</div>
            <a href="{{ route('add.instructor') }}" class="btn-add-instructor">
                + Add New Instructor
            </a>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa;">
                        <th style="padding: 15px; text-align: left; color: #555; font-weight: 600;">Image</th>
                        <th style="padding: 15px; text-align: left; color: #555; font-weight: 600;">Name</th>
                        <th style="padding: 15px; text-align: left; color: #555; font-weight: 600;">Designation</th>
                        <th style="padding: 15px; text-align: left; color: #555; font-weight: 600;">Social Links</th>
                        <th style="padding: 15px; text-align: left; color: #555; font-weight: 600;">Status</th>
                        <th style="padding: 15px; text-align: left; color: #555; font-weight: 600;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($instructors ?? [] as $instructor)
                    <tr style="border-bottom: 1px solid #ecf0f1;">
                        <td style="padding: 15px;">
                            @if($instructor->img)
                                <img src="{{ asset($instructor->img) }}"
                                     alt="{{ $instructor->name }}"
                                     style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
                            @else
                                <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                    {{ mb_substr($instructor->name, 0, 2) }}
                                </div>
                            @endif
                        </td>
                        <td style="padding: 15px; font-weight: 500;">{{ $instructor->name }}</td>
                        <td style="padding: 15px; color: #666;">{{ $instructor->designation }}</td>
                        <td style="padding: 15px;">
                            <div style="display: flex; gap: 8px;">
                                @if($instructor->facebook_link)
                                    <a href="{{ $instructor->facebook_link }}" target="_blank" rel="noopener noreferrer" style="text-decoration: none; color: #1877f2;">📘</a>
                                @endif
                                @if($instructor->twitter_link)
                                    <a href="{{ $instructor->twitter_link }}" target="_blank" rel="noopener noreferrer" style="text-decoration: none; color: #1da1f2;">🐦</a>
                                @endif
                                @if($instructor->instagram_link)
                                    <a href="{{ $instructor->instagram_link }}" target="_blank" rel="noopener noreferrer" style="text-decoration: none; color: #e4405f;">📷</a>
                                @endif
                                @if(!$instructor->facebook_link && !$instructor->twitter_link && !$instructor->instagram_link)
                                    <span style="color: #999; font-size: 12px;">—</span>
                                @endif
                            </div>
                        </td>
                        <td style="padding: 15px;">
                            @if($instructor->status == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td style="padding: 15px;">
                            <div style="display: flex; gap: 8px;">
                                <button onclick="editInstructor({{ $instructor->id }})"
                                        style="background: #3498db; color: white; border: none; padding: 5px 12px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                    Edit
                                </button>
                                <button onclick="deleteInstructor({{ $instructor->id }})"
                                        style="background: #e74c3c; color: white; border: none; padding: 5px 12px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 60px; text-align: center; color: #999;">
                            <div style="font-size: 48px; margin-bottom: 10px;">👨‍🏫</div>
                            <div>No instructors found</div>
                            <a href="{{ route('add.instructor') }}"
                               style="display: inline-block; margin-top: 15px; background: #1e3c72; color: white; padding: 8px 20px; border-radius: 6px; text-decoration: none; font-size: 14px;">
                                Add Your First Instructor
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Hidden CSRF form for delete requests --}}
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<style>
    .btn-add-instructor {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: transform 0.2s;
        display: inline-block;
    }

    .btn-add-instructor:hover {
        transform: translateY(-2px);
    }

    .recent-section table tbody tr:hover {
        background: #fafafa;
        transition: background 0.2s;
    }

    button {
        transition: opacity 0.2s;
    }

    button:hover {
        opacity: 0.8;
    }
</style>

<script>
    function editInstructor(id) {
        window.location.href = '/instructors/' + id + '/edit';
    }

    function deleteInstructor(id) {
        if (confirm('Are you sure you want to delete this instructor?')) {
            const form = document.getElementById('delete-form');
            form.action = '/instructors/' + id;
            form.submit();
        }
    }
</script>

@endsection

