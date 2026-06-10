@extends ('components.dashlayout')

@section('content')
<div class="main-content">
    <!-- Page Header -->
    <div class="header">
        <div>
            <h1 style="font-size: 28px; color: #1e3c72; margin-bottom: 5px;">Add New Instructor</h1>
            <p style="color: #7f8c8d; margin-top: 5px;">Onboard a new team member by filling in the details below</p>
        </div>
        <div class="user-info">
            <div class="avatar">AD</div>
            <span>Admin User</span>
        </div>
    </div>

    <!-- Form Card -->
    <div style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <form action="{{ route('instructor.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Two Column Layout -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
                
                <!-- Left Column -->
                <div>
                    <!-- Name -->
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Full Name <span style="color: #e74c3c;">*</span></label>
                        <input type="text" 
                               name="name" 
                               required
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                               placeholder="e.g. Sarah Johnson">
                    </div>

                    <!-- Designation -->
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Designation <span style="color: #e74c3c;">*</span></label>
                        <input type="text" 
                               name="designation" 
                               required
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                               placeholder="e.g. Senior Web Developer, UI/UX Expert">
                    </div>

                    <!-- Status -->
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Status</label>
                        <select name="status" 
                                style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; cursor: pointer;">
                            <option value="1">✅ Active</option>
                            <option value="0">⭕ Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Right Column -->
                <div>
                    <!-- Profile Image -->
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Profile Photo</label>
                        <div style="border: 2px dashed #d1d5db; border-radius: 10px; padding: 25px; text-align: center; background: #fafafa;">
                            <input type="file" 
                                   name="img" 
                                   accept="image/*"
                                   style="display: none;"
                                   id="imageInput">
                            <button type="button" 
                                    onclick="document.getElementById('imageInput').click()"
                                    style="background: #2563eb; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-size: 14px;">
                                📸 Choose File
                            </button>
                            <div id="imagePreviewContainer" style="margin-top: 15px; display: none;">
                                <img id="imagePreview" style="max-width: 120px; max-height: 120px; border-radius: 8px;">
                            </div>
                            <p style="color: #7f8c8d; font-size: 12px; margin-top: 12px;">JPG, PNG or GIF (Max 2MB)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Links Section -->
            <div style="margin-top: 20px; border-top: 1px solid #e5e5e5; padding-top: 25px;">
                <h3 style="margin-bottom: 20px; color: #1e3c72; font-size: 18px;">🔗 Social Media Links</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                    <!-- Facebook -->
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Facebook</label>
                        <input type="url" 
                               name="facebook_link"
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                               placeholder="https://facebook.com/username">
                    </div>

                    <!-- Twitter -->
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Twitter / X</label>
                        <input type="url" 
                               name="twitter_link"
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                               placeholder="https://twitter.com/username">
                    </div>

                    <!-- Instagram -->
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Instagram</label>
                        <input type="url" 
                               name="instagram_link"
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                               placeholder="https://instagram.com/username">
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 30px; border-top: 1px solid #e5e5e5; padding-top: 25px;">
                <button type="button" 
                        style="padding: 12px 25px; background: #e5e5e5; color: #374151; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 14px;">
                    Cancel
                </button>
                <button type="submit" 
                        style="padding: 12px 30px; background: #2563eb; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 14px;">
                    💾 Save Instructor
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Image preview functionality
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('imagePreviewContainer');
        const preview = document.getElementById('imagePreview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.src = event.target.result;
                previewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>

@endsection
