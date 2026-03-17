@extends('admin.layouts.default')

@section('title', 'Brand & Appearance')

@section('content')
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <div>
            <h5 class="mb-0">Brand & Appearance</h5>
            <nav class="text-sm text-gray-500 mt-1">
                <a href="{{ route('admin.settings.index') }}" class="text-gray-400 hover:text-gray-600">Settings</a>
                <span class="mx-2">›</span>
                <span>Brand</span>
            </nav>
        </div>
        <span style="background:#d1fae5;color:#065f46;font-size:12px;padding:5px 12px;border-radius:9999px;font-weight:500;">
            <i class="fas fa-check-circle mr-1"></i> Active
        </span>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0 list-disc list-inside">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.brand.save') }}" enctype="multipart/form-data">
        @csrf

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;max-width:900px;">

            {{-- Colors Card --}}
            <div class="card p-6 bg-white border rounded-xl shadow-sm">
                <h6 class="font-semibold mb-4" style="border-bottom:1px solid #e5e7eb;padding-bottom:0.75rem;">
                    <i class="fas fa-palette mr-2" style="color:var(--primary-color)"></i>Color Palette
                </h6>

                <div class="space-y-4">

                    {{-- Primary Color --}}
                    <div class="d-flex align-items-center justify-content-between" style="gap:1rem;">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Primary Color</label>
                            <p class="text-xs text-gray-400 mb-0">Main buttons, links, accents</p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <input type="color" name="primary_color"
                                   value="{{ old('primary_color', $brand->primary_color ?? '#28ADC4') }}"
                                   id="primary_color"
                                   oninput="document.getElementById('primary_hex').value=this.value"
                                   style="width:48px;height:38px;border:1px solid #d1d5db;border-radius:6px;cursor:pointer;padding:2px;">
                            <input type="text" id="primary_hex"
                                   value="{{ old('primary_color', $brand->primary_color ?? '#28ADC4') }}"
                                   oninput="document.getElementById('primary_color').value=this.value"
                                   style="width:90px;font-family:monospace;font-size:13px;" class="form-control">
                        </div>
                    </div>

                    {{-- Secondary Color --}}
                    <div class="d-flex align-items-center justify-content-between" style="gap:1rem;">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Secondary Color</label>
                            <p class="text-xs text-gray-400 mb-0">Headings, secondary UI elements</p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <input type="color" name="secondary_color"
                                   value="{{ old('secondary_color', $brand->secondary_color ?? '#0069a6') }}"
                                   id="secondary_color"
                                   oninput="document.getElementById('secondary_hex').value=this.value"
                                   style="width:48px;height:38px;border:1px solid #d1d5db;border-radius:6px;cursor:pointer;padding:2px;">
                            <input type="text" id="secondary_hex"
                                   value="{{ old('secondary_color', $brand->secondary_color ?? '#0069a6') }}"
                                   oninput="document.getElementById('secondary_color').value=this.value"
                                   style="width:90px;font-family:monospace;font-size:13px;" class="form-control">
                        </div>
                    </div>

                    {{-- Accent Color --}}
                    <div class="d-flex align-items-center justify-content-between" style="gap:1rem;">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Accent Color</label>
                            <p class="text-xs text-gray-400 mb-0">Table headers, highlights</p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <input type="color" name="accent_color"
                                   value="{{ old('accent_color', $brand->accent_color ?? '#008a8f') }}"
                                   id="accent_color"
                                   oninput="document.getElementById('accent_hex').value=this.value"
                                   style="width:48px;height:38px;border:1px solid #d1d5db;border-radius:6px;cursor:pointer;padding:2px;">
                            <input type="text" id="accent_hex"
                                   value="{{ old('accent_color', $brand->accent_color ?? '#008a8f') }}"
                                   oninput="document.getElementById('accent_color').value=this.value"
                                   style="width:90px;font-family:monospace;font-size:13px;" class="form-control">
                        </div>
                    </div>

                    {{-- Accent 2 Color --}}
                    <div class="d-flex align-items-center justify-content-between" style="gap:1rem;">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Accent Color 2</label>
                            <p class="text-xs text-gray-400 mb-0">Secondary accent (purple tones)</p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <input type="color" name="accent_2_color"
                                   value="{{ old('accent_2_color', $brand->accent_2_color ?? '#6f4693') }}"
                                   id="accent_2_color"
                                   oninput="document.getElementById('accent_2_hex').value=this.value"
                                   style="width:48px;height:38px;border:1px solid #d1d5db;border-radius:6px;cursor:pointer;padding:2px;">
                            <input type="text" id="accent_2_hex"
                                   value="{{ old('accent_2_color', $brand->accent_2_color ?? '#6f4693') }}"
                                   oninput="document.getElementById('accent_2_color').value=this.value"
                                   style="width:90px;font-family:monospace;font-size:13px;" class="form-control">
                        </div>
                    </div>

                    {{-- Sidebar Color --}}
                    <div class="d-flex align-items-center justify-content-between" style="gap:1rem;">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sidebar Color</label>
                            <p class="text-xs text-gray-400 mb-0">Navigation / sidebar background</p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <input type="color" name="sidebar_color"
                                   value="{{ old('sidebar_color', $brand->sidebar_color ?? '#152636') }}"
                                   id="sidebar_color"
                                   oninput="document.getElementById('sidebar_hex').value=this.value"
                                   style="width:48px;height:38px;border:1px solid #d1d5db;border-radius:6px;cursor:pointer;padding:2px;">
                            <input type="text" id="sidebar_hex"
                                   value="{{ old('sidebar_color', $brand->sidebar_color ?? '#152636') }}"
                                   oninput="document.getElementById('sidebar_color').value=this.value"
                                   style="width:90px;font-family:monospace;font-size:13px;" class="form-control">
                        </div>
                    </div>

                </div>
            </div>

            {{-- Fonts Card --}}
            <div class="card p-6 bg-white border rounded-xl shadow-sm">
                <h6 class="font-semibold mb-4" style="border-bottom:1px solid #e5e7eb;padding-bottom:0.75rem;">
                    <i class="fas fa-font mr-2" style="color:var(--primary-color)"></i>Typography
                </h6>

                <div class="space-y-4">

                    {{-- Body Font --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Body Font</label>
                        <p class="text-xs text-gray-400 mb-2">Main text across all pages</p>
                        <select name="font_body" class="form-control">
                            @foreach(['Lato','Nunito','Poppins','Roboto','Open Sans','Inter','Raleway','Montserrat','Source Sans 3','Ubuntu'] as $font)
                                <option value="{{ $font }}" {{ ($brand->font_body ?? 'Lato') === $font ? 'selected' : '' }}>
                                    {{ $font }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Heading Font --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading Font</label>
                        <p class="text-xs text-gray-400 mb-2">H1–H6 and property titles</p>
                        <select name="font_heading" class="form-control">
                            @foreach(['Julius Sans One','Playfair Display','Merriweather','Cinzel','Cormorant Garamond','Josefin Sans','Montserrat','Lato','Nunito','Poppins'] as $font)
                                <option value="{{ $font }}" {{ ($brand->font_heading ?? 'Julius Sans One') === $font ? 'selected' : '' }}>
                                    {{ $font }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Admin Font --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Admin Panel Font</label>
                        <p class="text-xs text-gray-400 mb-2">Font used inside the admin panel</p>
                        <select name="font_admin" class="form-control">
                            @foreach(['Lato','Nunito','Poppins','Roboto','Open Sans','Inter','Raleway','Montserrat','Source Sans 3'] as $font)
                                <option value="{{ $font }}" {{ ($brand->font_admin ?? 'Lato') === $font ? 'selected' : '' }}>
                                    {{ $font }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Live font preview --}}
                    <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:1rem;margin-top:0.5rem;">
                        <p class="text-xs text-gray-400 mb-1">Preview (uses saved fonts)</p>
                        <p style="font-family:var(--font-heading);font-size:18px;margin:0 0 4px;">The quick brown fox</p>
                        <p style="font-family:var(--font-body);font-size:13px;color:#6b7280;margin:0;">The quick brown fox jumps over the lazy dog.</p>
                    </div>

                </div>
            </div>

        </div>

        {{-- Identity & Media Card --}}
        <div class="card p-6 bg-white border rounded-xl shadow-sm mt-4" style="max-width:900px;">
            <h6 class="font-semibold mb-4" style="border-bottom:1px solid #e5e7eb;padding-bottom:0.75rem;">
                <i class="fas fa-image mr-2" style="color:var(--primary-color)"></i>Identity & Media
            </h6>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;">

                {{-- Logo --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Site Logo</label>
                    <p class="text-xs text-gray-400 mb-3">Shown in the sidebar, admin panel, and agent portal. PNG or SVG recommended.</p>
                    @if($brand && $brand->logo_path)
                        <div class="mb-3" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:12px;display:inline-block;">
                            <img src="{{ asset($brand->logo_path) }}" alt="Current Logo" style="height:48px;max-width:200px;object-fit:contain;">
                        </div>
                        <p class="text-xs text-gray-400 mb-2">Current logo — upload a new file to replace it.</p>
                    @endif
                    <input type="file" name="logo" accept="image/png,image/jpeg,image/jpg,image/gif,image/svg+xml,image/webp"
                           class="form-control" style="font-size:13px;">
                    <p class="text-xs text-gray-400 mt-1">Max 2MB. PNG/SVG recommended (transparent background).</p>
                </div>

                {{-- Favicon --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Favicon</label>
                    <p class="text-xs text-gray-400 mb-3">Browser tab icon. ICO, PNG, or SVG format. Recommended size: 32×32 or 64×64 px.</p>
                    @if($brand && $brand->favicon_path)
                        <div class="mb-3" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:12px;display:inline-block;">
                            <img src="{{ asset($brand->favicon_path) }}" alt="Current Favicon" style="height:32px;width:32px;object-fit:contain;">
                        </div>
                        <p class="text-xs text-gray-400 mb-2">Current favicon — upload a new file to replace it.</p>
                    @endif
                    <input type="file" name="favicon" accept=".ico,image/png,image/jpeg,image/svg+xml"
                           class="form-control" style="font-size:13px;">
                    <p class="text-xs text-gray-400 mt-1">Max 512KB. ICO or PNG preferred.</p>
                </div>

            </div>
        </div>

        {{-- Actions --}}
        <div class="d-flex align-items-center gap-3 mt-4" style="max-width:900px;padding-top:1rem;border-top:1px solid #e5e7eb;margin-top:1.5rem;">
            <a href="{{ route('admin.settings.index') }}" class="text-sm text-gray-500">← Back to Settings</a>
            <button type="submit" class="button button-green button-sm ml-auto">
                Save Brand Settings
            </button>
        </div>

    </form>
@stop

@push('scripts')
<script>
    // Keep hex text inputs in sync with color pickers
    document.querySelectorAll('input[type="text"][id$="_hex"]').forEach(function(input) {
        input.addEventListener('change', function() {
            var val = this.value;
            if (/^#[0-9A-Fa-f]{6}$/.test(val)) {
                var colorId = this.id.replace('_hex', '');
                document.getElementById(colorId).value = val;
            }
        });
    });
</script>
@endpush
