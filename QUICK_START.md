# Quick Start Guide - Code Structure

## 🎯 Development Workflow

### 1. Start Development Server
```bash
npm run dev
# This watches for changes in:
# - resources/css/
# - resources/js/
# - Automatically rebuilds on save
```

### 2. Build for Production
```bash
npm run build
# Creates optimized assets in public/build/
# Run this before deploying
```

---

## 📝 Adding New Features

### Scenario: Create New Page with Styles & JS

#### Step 1: Create CSS
File: `resources/css/new-feature.css`
```css
/* New Feature Styles */
.new-feature {
  /* your styles */
}
```

#### Step 2: Create JS Module
File: `resources/js/modules/new-feature.js`
```javascript
export function initNewFeature() {
  // Your logic here
  console.log('New feature initialized');
  
  // Example: Event listener
  const btn = document.getElementById('feature-btn');
  if (btn) {
    btn.addEventListener('click', () => {
      // Handle click
    });
  }
}
```

#### Step 3: Create Blade File
File: `resources/views/public/new-feature.blade.php`
```blade
@extends('public.layout')

@section('title', 'New Feature')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/new-feature.css') }}">
@endpush

@section('content')
  <!-- Your HTML here -->
  <div id="feature-btn">Click me</div>
@endsection

@push('scripts')
<script type="module">
  import { initNewFeature } from '{{ asset('js/modules/new-feature.js') }}';
  initNewFeature();
</script>
@endpush
```

---

## 🔍 File Organization Reference

### CSS Files Purpose

| File | Purpose | Examples |
|------|---------|----------|
| `app.css` | Tailwind config | Import tailwindcss |
| `layout.css` | Header/footer/global | `body`, `.scrolled` |
| `animations.css` | All @keyframes | `@keyframes fadeIn`, `@keyframes float` |
| `infografis.css` | Infografis page | `.glass-effect`, `.gradient-card-*` |
| `pengaduan.css` | Form page | `@media prefers-reduced-motion` |
| `sotk.css` | Organization tree | `.tree-wrapper`, `.node`, `.children` |
| `profil.css` | Profile page | `.fade-in-section` |

### JS Module Purpose

| File | Purpose | Key Functions |
|------|---------|------------------|
| `layout.js` | Header interactions | `initLayout()` - scroll effect, menu toggle |
| `infografis.js` | Charts | `initInfografis()` - Chart.js setup |
| `pengaduan.js` | Form handling | `initPengaduan()` - reCAPTCHA logic |
| `sotk.js` | Modal & drag | `initSotk()` - modal, drag scroll |
| `profil.js` | Modal funcs | `initProfil()` - open/close/download |
| `libraries.js` | External libs | `initLibraries()` - AOS init |
| `app-init.js` | Entry point | Import & init all modules |

---

## 💾 Data Passing from PHP to JS

### Method 1: Window Object (Recommended)
```blade
<!-- In blade file -->
@push('scripts')
<script>
  window.pageData = @json([
    'title' => 'My Page',
    'items' => $items,
    'userId' => auth()->id()
  ]);
</script>
@endpush

<!-- In JavaScript module -->
export function initMyModule() {
  const data = window.pageData;
  console.log(data.title); // 'My Page'
}
```

### Method 2: Data Attributes
```blade
<div id="my-element" data-count="{{ $count }}" data-items='@json($items)'>
```

```javascript
export function initMyModule() {
  const el = document.getElementById('my-element');
  if (!el) return;
  
  const count = el.dataset.count;
  const items = JSON.parse(el.dataset.items);
}
```

### Method 3: Meta Tags
```blade
<meta name="user-id" content="{{ auth()->id() }}">
<meta name="api-token" content="{{ csrf_token() }}">
```

```javascript
export function initMyModule() {
  const userId = document.querySelector('meta[name="user-id"]').content;
  const token = document.querySelector('meta[name="api-token"]').content;
}
```

---

## 🐛 Debugging

### Check if Module Loaded
```javascript
// In browser console
window.infografisData // Should show data object
// If undefined, check if @push('scripts') executed
```

### Check CSS Loaded
```javascript
// In browser console
getComputedStyle(document.body).fontFamily // Should show 'Inter'
```

### Common Issues

| Issue | Solution |
|-------|----------|
| Styles not applied | Run `npm run build` |
| JS not running | Check browser console for errors |
| Data undefined | Ensure @push('scripts') with window object |
| Module not found | Check file path in import statement |
| Event listener not working | Verify element exists (use `if (!el) return`) |

---

## 📋 Checklist: Before Pushing Code

- [ ] Run `npm run build` successfully
- [ ] No JavaScript errors in console
- [ ] Styles applied correctly
- [ ] All interactions working
- [ ] Responsive design works
- [ ] Form validation works
- [ ] Data loads correctly
- [ ] Modal opens/closes
- [ ] No console warnings

---

## 🎓 Best Practices

### ✅ DO

```javascript
// ✅ Check element exists before using
export function initMyModule() {
  const el = document.getElementById('my-el');
  if (!el) return; // Exit if not on this page
  
  el.addEventListener('click', () => {
    // Handle
  });
}

// ✅ Use window object for data
const data = window.infografisData;

// ✅ Export functions
export function initFeature() { }

// ✅ Use data attributes for HTML-JS communication
<div id="card" data-id="123">
```

### ❌ DON'T

```javascript
// ❌ Don't assume element exists
document.getElementById('nonexistent').addEventListener('click', () => {
  // Throws error if element not found
});

// ❌ Don't use inline JavaScript in blade
<button onclick="myFunction()">Bad!</button>

// ❌ Don't hardcode values
const userId = 'hardcoded-id';

// ❌ Don't create global variables
myGlobalVar = 123; // Bad practice

// ❌ Don't duplicate code across modules
// Instead, create utility functions
```

---

## 📚 File Locations Quick Reference

```
Resources are in: c:\laragon\www\DesaSukaraja\resources\

CSS:        resources/css/
JS:         resources/js/
Modules:    resources/js/modules/
Views:      resources/views/
```

---

## 🔗 Useful Links in Code

- **Main Layout**: `resources/views/public/layout.blade.php`
- **App Init**: `resources/js/app-init.js`
- **Tailwind Config**: `resources/css/app.css`
- **Build Config**: `vite.config.js`

---

## 📞 Common Commands

```bash
# Development
npm run dev              # Start watch mode

# Production
npm run build            # Build for production

# Install dependencies (if needed)
npm install

# Update dependencies
npm update

# Check for vulnerabilities
npm audit

# Clean up
rm -r node_modules && npm install  # Hard reset
```

---

## 🎯 Success Indicators

After cleanup, you should see:

- ✅ No `<style>` tags in .blade.php files
- ✅ No `<script>` tags with logic in .blade.php files (except @push)
- ✅ Clear separation: HTML in blade, CSS in .css, JS in .js
- ✅ npm run build completes without errors
- ✅ All pages load and function correctly
- ✅ Bundle size optimized

**Status: All checked! 🎉**
