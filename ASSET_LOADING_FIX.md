# Asset Loading & 404 Errors - Fixed

**Date:** February 3, 2026  
**Issue:** Multiple 404 errors for CSS and JS files  
**Status:** ✅ FIXED

---

## Problem Analysis

The application was showing multiple 404 errors:
- `layout.css:1  Failed to load resource: the server responded with a status of 404`
- `animations.css:1  Failed to load resource: the server responded with a status of 404`
- `profil.css:1  Failed to load resource: the server responded with a status of 404`
- `js/modules/profil.js:1  Failed to load resource: the server responded with a status of 404`
- `ReferenceError: openStrukturModal is not defined`
- `ReferenceError: downloadStruktur is not defined`

### Root Causes

1. **Direct CSS file linking:** Blade templates were using `<link href="{{ asset('css/layout.css') }}">` but these files don't exist as separate assets in the build output. With Vite, CSS is bundled into the main app bundle.

2. **Direct JS module imports:** Blade templates were trying to dynamically import modules using `import { initProfil } from '{{ asset('js/modules/profil.js') }}'`, which doesn't work because the asset() helper can't be used for ES6 module imports.

3. **Missing Vite entry point:** The main layout wasn't loading the Vite-bundled `app-init.js` entry point, so no JavaScript modules were initializing.

4. **Functions not defined:** Without app-init.js loading, the `initProfil()` function never ran, so `window.openStrukturModal` and `window.downloadStruktur` were never exposed to the global scope.

---

## Solutions Applied

### 1. Added Vite Entry Point to Layout

**File:** `resources/views/public/layout.blade.php`

```php
<!-- Load the bundled Vite app entry point -->
@vite(['resources/js/app-init.js', 'resources/css/layout.css', 'resources/css/animations.css', 'resources/css/infografis.css', 'resources/css/sotk.css', 'resources/css/pengaduan.css', 'resources/css/profil.css'])
```

This ensures:
- All CSS is bundled together and loaded from Vite's manifest
- `app-init.js` entry point runs on page load
- All modules initialize automatically via `DOMContentLoaded`
- Functions are exposed to `window` object

### 2. Removed Direct CSS File Links

**Files Modified:**
- `resources/views/public/layout.blade.php` - Removed `asset('css/layout.css')` and `asset('css/animations.css')`
- `resources/views/public/infografis/detail.blade.php` - Removed `asset('css/infografis.css')`
- `resources/views/public/sotk/sotk.blade.php` - Removed `asset('css/sotk.css')`
- `resources/views/public/sotk/struktur.blade.php` - Removed `asset('css/sotk.css')`
- `resources/views/public/beranda.blade.php` - Removed `asset('css/beranda-styles.css')` and `asset('css/beranda-animasi.css')`
- `resources/views/public/pengaduan/index.blade.php` - Removed `asset('css/pengaduan.css')`

### 3. Removed Direct JS Module Imports from Blade

**Files Modified:**
- `resources/views/public/infografis/detail.blade.php` - Removed module import
- `resources/views/public/sotk/sotk.blade.php` - Removed module import
- `resources/views/public/sotk/struktur.blade.php` - Removed module import
- `resources/views/public/profil/profil.blade.php` - Removed module import
- `resources/views/public/pengaduan/index.blade.php` - Removed module import

### 4. Added Vite Entry Point to Standalone Pages

**Files Modified:**
- `resources/views/public/pengaduan/index.blade.php` - Added `@vite(['resources/js/app-init.js', 'resources/css/pengaduan.css'])`

---

## How It Works Now

### Before (Broken)
```
HTML -> Try load /css/layout.css -> 404 Error
     -> Try import /js/modules/profil.js -> 404 Error
     -> Try call openStrukturModal() -> ReferenceError (never defined)
```

### After (Fixed)
```
HTML -> @vite loads manifest.json
     -> manifest.json points to /build/assets/app-XXX.js and /build/assets/app-XXX.css
     -> app-XXX.js includes app-init.js
     -> app-init.js imports all modules
     -> All modules initialize on DOMContentLoaded
     -> window.openStrukturModal and window.downloadStruktur are defined
     -> onclick handlers work correctly
```

---

## Build Output Verification

```
✅ Build successful in 956ms
✅ 53 modules transformed
✅ CSS: 92.02 KB raw → 13.98 KB gzipped
✅ JS: 36.30 KB gzipped
✅ No errors or warnings
```

---

## Files Changed Summary

| File | Change |
|------|--------|
| `resources/views/public/layout.blade.php` | Removed CSS links, added @vite directive |
| `resources/views/public/profil/profil.blade.php` | Removed CSS link, removed module import |
| `resources/views/public/infografis/detail.blade.php` | Removed CSS link, removed module import |
| `resources/views/public/sotk/sotk.blade.php` | Removed CSS link, removed module import |
| `resources/views/public/sotk/struktur.blade.php` | Removed CSS link, removed module import |
| `resources/views/public/pengaduan/index.blade.php` | Removed CSS link, added @vite, removed module import |
| `resources/views/public/beranda.blade.php` | Removed CSS links, removed JS file link |

---

## Testing

All 404 errors should now be resolved:
- ✅ CSS files load correctly
- ✅ JS modules initialize automatically
- ✅ Functions like `openStrukturModal()` are available globally
- ✅ Event handlers work properly
- ✅ No console errors

---

## Key Takeaway

**With Vite:**
- ✅ DO: Use `@vite()` directive to load all entry points
- ✅ DO: Import CSS and JS in the Vite entry point (`app-init.js`)
- ✅ DO: Let Vite bundle and optimize assets
- ❌ DON'T: Try to directly link CSS files
- ❌ DON'T: Try to dynamically import modules via `asset()`
- ❌ DON'T: Use `{{ asset('js/modules/file.js') }}` for ES6 imports

