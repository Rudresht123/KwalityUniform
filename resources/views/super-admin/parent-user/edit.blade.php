@extends('layouts.common')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

    .g-root, .g-root * {
        box-sizing: border-box;
    }

    .g-root {
        --bg: #f4f5fb;
        --surface: #ffffff;
        --surface-soft: #fafaff;
        --ink: #1a1a2e;
        --ink-soft: #6b6b85;
        --ink-faint: #9a9ab0;
        --line: #eaeaf3;

        --primary: #4338ca;
        --primary-ink: #372e8a;
        --primary-soft: #edecfd;

        --amber: #dc8a00;
        --amber-soft: #fdf1dd;
        --green: #158f63;
        --green-soft: #e4f6ee;
        --red: #d64545;
        --red-soft: #fce9e9;
        --teal: #0e829b;
        --teal-soft: #e3f4f8;
        --violet: #6f4ff2;
        --violet-soft: #efeafe;
        --gray-soft: #f1f1f7;

        --radius-lg: 18px;
        --radius-md: 12px;
        --radius-sm: 8px;
        --shadow-card: 0 1px 2px rgba(26,26,46,.04), 0 10px 24px -18px rgba(26,26,46,.18);

        color: var(--ink);
        background: var(--bg);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        padding: 24px;
        border-radius: 20px;
    }

    .g-root h1, .g-root h2, .g-root h3, .g-root .panel-title {
        font-family: 'Sora', 'Inter', sans-serif;
    }

    .g-form-wrap {
        max-width: 880px;
        margin: 0 auto;
    }

    /* ── Hero header ── */
    .form-hero {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        background: linear-gradient(120deg, var(--primary) 0%, #6f4ff2 100%);
        border-radius: var(--radius-lg);
        padding: 24px 26px;
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: 0 16px 32px -18px rgba(67,56,202,.5);
    }

    .form-hero::after {
        content: '';
        position: absolute;
        right: -50px;
        top: -60px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
    }

    .form-hero-left {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .avatar-circle {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: rgba(255,255,255,.18);
        border: 1.5px solid rgba(255,255,255,.35);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Sora', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: #fff;
        flex-shrink: 0;
    }

    .form-hero h2 {
        color: #fff;
        font-size: 21px;
        font-weight: 700;
        margin: 0 0 4px;
    }

    .form-hero p {
        color: rgba(255,255,255,.82);
        margin: 0;
        font-size: 13px;
    }

    .btn-pill {
        position: relative;
        z-index: 1;
        font-size: 12.5px;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 30px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: transform .15s ease, opacity .15s ease, background .15s ease;
        white-space: nowrap;
    }

    .btn-pill:hover { transform: translateY(-1px); }
    .btn-pill-ghost { background: rgba(255,255,255,.14); color: #fff; border: 1px solid rgba(255,255,255,.35); }

    /* ── Panels ── */
    .panel {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: var(--radius-lg);
        padding: 22px 24px 24px;
        margin-bottom: 14px;
        box-shadow: var(--shadow-card);
    }

    .panel-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 18px;
        padding-bottom: 13px;
        border-bottom: 1px solid var(--line);
    }

    .panel-title .step-badge {
        width: 24px;
        height: 24px;
        border-radius: 8px;
        background: var(--primary-soft);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        flex-shrink: 0;
    }

    /* ── Grid ── */
    .g-row {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 16px;
    }

    .g-row + .g-row { margin-top: 16px; }

    .g-col-2 { grid-column: span 2; }
    .g-col-3 { grid-column: span 3; }
    .g-col-4 { grid-column: span 4; }
    .g-col-6 { grid-column: span 6; }
    .g-col-12 { grid-column: span 12; }

    @media (max-width: 768px) {
        .g-col-2, .g-col-3, .g-col-4, .g-col-6, .g-col-12 { grid-column: span 12; }
    }

    /* ── Fields ── */
    .field-group { display: flex; flex-direction: column; }

    .field-label {
        font-size: 11.5px;
        font-weight: 600;
        color: var(--ink-soft);
        text-transform: uppercase;
        letter-spacing: .4px;
        margin-bottom: 7px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .field-label .req { color: var(--red); }

    .input-icon-wrap { position: relative; }

    .input-icon-wrap i.field-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 15px;
        color: var(--ink-faint);
        pointer-events: none;
    }

    .g-root .form-control,
    .g-root .form-select,
    .g-root textarea.form-control {
        background: var(--surface-soft);
        border: 1.5px solid var(--line);
        border-radius: var(--radius-md);
        padding: 10px 14px;
        font-size: 13.5px;
        color: var(--ink);
        font-family: 'Inter', sans-serif;
        width: 100%;
        transition: border-color .15s ease, box-shadow .15s ease, background .15s ease;
    }

    .input-icon-wrap .form-control,
    .input-icon-wrap .form-select { padding-left: 38px; }

    .g-root .form-control::placeholder { color: var(--ink-faint); }

    .g-root .form-control:focus,
    .g-root .form-select:focus {
        outline: none;
        border-color: var(--primary);
        background: var(--surface);
        box-shadow: 0 0 0 3px var(--primary-soft);
    }

    .g-root .form-control.is-invalid,
    .g-root .form-select.is-invalid {
        border-color: var(--red);
        background: var(--red-soft);
    }

    .g-root .invalid-feedback {
        display: block;
        font-size: 11.5px;
        color: var(--red);
        margin-top: 6px;
        font-weight: 500;
    }

    .field-hint {
        font-size: 11px;
        color: var(--ink-faint);
        margin-top: 6px;
    }

    .g-root textarea.form-control { resize: vertical; min-height: 90px; }

    /* ── Actions ── */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: var(--radius-lg);
        padding: 16px 20px;
        box-shadow: var(--shadow-card);
        position: sticky;
        bottom: 16px;
    }

    .btn-cancel {
        background: var(--surface-soft);
        color: var(--ink-soft);
        border: 1.5px solid var(--line);
    }

    .btn-cancel:hover { background: var(--gray-soft); color: var(--ink); }

    .btn-submit {
        background: var(--primary);
        color: #fff;
    }

    .btn-submit:hover { background: var(--primary-ink); }
</style>

<div class="g-root">
    <div class="g-form-wrap">

        {{-- ══════════════════════════════
             HERO HEADER
        ══════════════════════════════ --}}
        <div class="form-hero">
            <div class="form-hero-left">
                <div class="avatar-circle">
                    {{ strtoupper(substr($user->name ?? 'P', 0, 1)) }}
                </div>
                <div>
                    <h2>Edit Parent User</h2>
                    <p>Update account, address and emergency contact details.</p>
                </div>
            </div>
            <a href="{{ route('parent-user.index') }}" class="btn-pill btn-pill-ghost">
                <i class="ti ti-arrow-left"></i> Back to list
            </a>
        </div>

        <form action="{{ route('parent-user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- ══════════════════════════════
                 ACCOUNT INFORMATION
            ══════════════════════════════ --}}
            <div class="panel">
                <div class="panel-title"><span class="step-badge">1</span> Account Information</div>

                <div class="g-row">
                    <div class="g-col-4 field-group">
                        <label class="field-label">Full Name <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="ti ti-user field-icon"></i>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        </div>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-4 field-group">
                        <label class="field-label">Username <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="ti ti-at field-icon"></i>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" required>
                        </div>
                        @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-4 field-group">
                        <label class="field-label">Email Address <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="ti ti-mail field-icon"></i>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        </div>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-4 field-group">
                        <label class="field-label">Password</label>
                        <div class="input-icon-wrap">
                            <i class="ti ti-lock field-icon"></i>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Leave blank to keep current">
                        </div>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-4 field-group">
                        <label class="field-label">Phone <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="ti ti-phone field-icon"></i>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" required>
                        </div>
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-4 field-group">
                        <label class="field-label">Gender</label>
                        <div class="input-icon-wrap">
                            <i class="ti ti-gender-bigender field-icon"></i>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $parent->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $parent->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $parent->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-4 field-group">
                        <label class="field-label">Date of Birth</label>
                        <div class="input-icon-wrap">
                            <i class="ti ti-cake field-icon"></i>
                            <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth', $parent->date_of_birth ?? '') }}">
                        </div>
                        @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-4 field-group">
                        <label class="field-label">National ID</label>
                        <div class="input-icon-wrap">
                            <i class="ti ti-id field-icon"></i>
                            <input type="text" name="national_id" class="form-control @error('national_id') is-invalid @enderror" value="{{ old('national_id', $parent->national_id ?? '') }}">
                        </div>
                        @error('national_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-4 field-group">
                        <label class="field-label">Alternate Phone</label>
                        <div class="input-icon-wrap">
                            <i class="ti ti-phone-plus field-icon"></i>
                            <input type="text" name="alternate_phone" class="form-control @error('alternate_phone') is-invalid @enderror" value="{{ old('alternate_phone', $parent->alternate_phone ?? '') }}">
                        </div>
                        @error('alternate_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════
                 ADDRESS INFORMATION
            ══════════════════════════════ --}}
            <div class="panel">
                <div class="panel-title"><span class="step-badge">2</span> Address Information</div>

                <div class="g-row">
                    <div class="g-col-6 field-group">
                        <label class="field-label">Address</label>
                        <div class="input-icon-wrap">
                            <i class="ti ti-map-pin field-icon"></i>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $parent->address ?? '') }}">
                        </div>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-2 field-group">
                        <label class="field-label">City</label>
                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $parent->city ?? '') }}">
                        @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-2 field-group">
                        <label class="field-label">State</label>
                        <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state', $parent->state ?? '') }}">
                        @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-2 field-group">
                        <label class="field-label">Zip Code</label>
                        <input type="text" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="{{ old('zip_code', $parent->zip_code ?? '') }}">
                        @error('zip_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════
                 EMERGENCY CONTACT
            ══════════════════════════════ --}}
            <div class="panel">
                <div class="panel-title"><span class="step-badge">3</span> Emergency Contact</div>

                <div class="g-row">
                    <div class="g-col-4 field-group">
                        <label class="field-label">Contact Name</label>
                        <div class="input-icon-wrap">
                            <i class="ti ti-user-heart field-icon"></i>
                            <input type="text" name="emergency_contact_name" class="form-control @error('emergency_contact_name') is-invalid @enderror" value="{{ old('emergency_contact_name', $parent->emergency_contact_name ?? '') }}">
                        </div>
                        @error('emergency_contact_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-4 field-group">
                        <label class="field-label">Contact Phone</label>
                        <div class="input-icon-wrap">
                            <i class="ti ti-phone-call field-icon"></i>
                            <input type="text" name="emergency_contact_phone" class="form-control @error('emergency_contact_phone') is-invalid @enderror" value="{{ old('emergency_contact_phone', $parent->emergency_contact_phone ?? '') }}">
                        </div>
                        @error('emergency_contact_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-4 field-group">
                        <label class="field-label">Relationship</label>
                        <div class="input-icon-wrap">
                            <i class="ti ti-users field-icon"></i>
                            <input type="text" name="emergency_contact_relationship" class="form-control @error('emergency_contact_relationship') is-invalid @enderror" value="{{ old('emergency_contact_relationship', $parent->emergency_contact_relationship ?? '') }}">
                        </div>
                        @error('emergency_contact_relationship') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="g-col-12 field-group">
                        <label class="field-label">Notes</label>
                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $parent->notes ?? '') }}</textarea>
                        @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="field-hint">Any additional information relevant to this parent's account.</div>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════
                 ACTIONS
            ══════════════════════════════ --}}
            <div class="form-actions">
                <a href="{{ route('parent-user.index') }}" class="btn-pill btn-cancel">Cancel</a>
                <button type="submit" class="btn-pill btn-submit"><i class="ti ti-device-floppy"></i> Update Parent User</button>
            </div>
        </form>

    </div>
</div>
@endsection