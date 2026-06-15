@extends('components.dashlayout')

@section('content')
<div class="main-content">
    <h1>Edit Instructor: {{ $instructor->name }}</h1>
    
    <form action="{{ route('instructors.update', $instructor->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Name</label>
            <input type="text" name="name" value="{{ $instructor->name }}" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Designation</label>
            <input type="text" name="designation" value="{{ $instructor->designation }}" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Social Links</label>
            <input type="url" name="facebook_link" value="{{ $instructor->facebook_link }}" placeholder="Facebook URL" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 5px;">
            <input type="url" name="twitter_link" value="{{ $instructor->twitter_link }}" placeholder="Twitter URL" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 5px;">
            <input type="url" name="instagram_link" value="{{ $instructor->instagram_link }}" placeholder="Instagram URL" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Status</label>
            <select name="status" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="1" {{ $instructor->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $instructor->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Profile Image</label>
            <input type="file" name="img" accept="image/*" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            @if($instructor->img)
                <div style="margin-top: 10px;">
                    <img src="{{ asset($instructor->img) }}" width="100" style="border-radius: 4px;">
                </div>
            @endif
        </div>
        
        <div style="display: flex; gap: 15px; margin-top: 30px;">
            <button type="submit" style="
                flex: 1; 
                padding: 12px; 
                background-color: #2563eb; 
                color: white; 
                border: none; 
                border-radius: 6px; 
                cursor: pointer; 
                font-weight: 600; 
                font-size: 14px;">
                Update Instructor
            </button>
            
            <a href="{{ route('show.instructors') }}" style="
                flex: 1; 
                padding: 12px; 
                background-color: #6b7280; 
                color: white; 
                border-radius: 6px; 
                text-decoration: none; 
                text-align: center; 
                font-weight: 600; 
                font-size: 14px;">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection